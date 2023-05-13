<?php

namespace App\Http\Controllers\Project;

use App\Models\LogPlan;
use App\Models\LogActual;
use App\Models\MstProject;
use Illuminate\Support\Str;
use App\Models\TranBaseline;
use Illuminate\Http\Request;
use App\Models\TranSupervisi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\LogAdministrasi;
use App\Models\TranAdministrasi;
use Illuminate\Support\Facades\Validator;

class ActualController extends Controller
{
    public function actualActivity($id, $slug)
    {
        $user_id =  getUser()->id;
        if (activeGuard() == 'waspang') {
            $user = "waspang_id = $user_id ";
        } else if (activeGuard() == 'tim-ut') {
            $user = "tim_ut_id = $user_id ";
        } else {
            $user = "mitra_id = $user_id ";
        }

        $check = TranSupervisi::whereRaw("$user AND id = $id")->exists();
        if ($check == 0) {
            return abort(404);
        }
        $supervisi =  TranSupervisi::whereRaw("$user AND id = $id")->first();
        $lists = TranBaseline::where("project_id", $supervisi->project_id)->get();
        $lists_asc_date = TranBaseline::where("project_id", $supervisi->project_id)->orderBy('plan_finish', 'ASC')->get();
        $end_date_plan = TranBaseline::where("project_id", $supervisi->project_id)->whereNotNull('plan_finish')->orderBy('plan_finish', 'Desc')->first();
        $end_date_actual = TranBaseline::where("project_id", $supervisi->project_id)->whereNotNull('actual_finish')->orderBy('actual_finish', 'Desc')->first();
        $countBase = TranBaseline::where("project_id", $supervisi->project_id)->where('bobot', '>=', '1')->count();
        $sumBase = TranBaseline::where("project_id", $supervisi->project_id)->where('bobot', '>=', '1')->sum('bobot');
        $countPlan = TranBaseline::where("project_id", $supervisi->project_id)->where('plan_durasi', '>=', '1')->count();
        $countActual = TranBaseline::where("project_id", $supervisi->project_id)->where('actual_finish', '>=', '1')->count();
        $sumDurasi = TranBaseline::where("project_id", $supervisi->project_id)->where('plan_durasi', '>=', '1')->sum('plan_durasi');
        $today = date('Y-m-d');
        $progress_plan = TranBaseline::where("project_id", $supervisi->project_id)->whereBetween('plan_finish', [$supervisi->supervisi_project->start_date,  $today])->sum('bobot');

        $cek_last_preparing = TranBaseline::select('actual_finish')
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 2)
            ->first();
        $cek_all_delivery = cek_all_delivery($supervisi->project_id);


        $cek_all_delivery_finish = cek_all_delivery_finish($supervisi->project_id);

        $cek_all_installasi = cek_all_installasi($supervisi->project_id);

        $cek_all_installasi_finish = cek_all_installasi_finish($supervisi->project_id);

        $cek_commisioning_tes = TranBaseline::select('actual_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereNotNull('actual_finish')
            ->where('actual_finish', '<>', '')
            ->where('activity_id', 20)->exists();

        $cek_ut = TranBaseline::select('actual_finish')
            ->where('project_id', $supervisi->project_id)
            ->where('approval_tim_ut', 'APPROVED')
            ->whereNotNull('actual_finish')
            ->where('actual_finish', '<>', '')
            ->where('activity_id', 21)->exists();

        $cek_rekon = TranBaseline::select('actual_finish')
            ->where('project_id', $supervisi->project_id)
            ->where('actual_task', 'APPROVED')
            ->whereNotNull('actual_finish')
            ->where('actual_finish', '<>', '')
            ->where('activity_id', 22)->exists();
        $sum_selesai = TranBaseline::where("project_id", $supervisi->project_id)->where("actual_progress", 100)->sum('bobot');
        $sum_belum = TranBaseline::where("project_id", $supervisi->project_id)->whereBetween('actual_progress', [1, 99])->sum('progress_bobot');

        $pageTitle  = $supervisi->project_name;

        return view(
            'pengguna.pages.supervisi.actual-activity',
            compact(
                'pageTitle',
                'lists',
                'countBase',
                'sumBase',
                'countPlan',
                'countActual',
                'sumDurasi',
                'lists',
                'lists_asc_date',
                'supervisi',
                'cek_last_preparing',
                'cek_all_delivery',
                'cek_all_delivery_finish',
                'cek_all_installasi',
                'cek_all_installasi_finish',
                'cek_commisioning_tes',
                'cek_ut',
                'cek_rekon',
                'progress_plan',
                'sum_selesai',
                'sum_belum',
                'end_date_plan',
                'end_date_actual',
            )
        );
    }

    public function actualActivityLog($id, $slug)
    {
        $baseline = TranBaseline::findOrFail($id);
        $supervisi = TranSupervisi::select('task')->where("project_id", $baseline->project_id)->first();
        $logs = LogActual::where("tran_baseline_id", $id)->orderBy('id', 'desc')->get();

        $pageTitle  = $baseline->list_activity;
        $breadcrumb = [
            'Log Actual',
            $baseline->project->lop_site_id
        ];
        return view(
            'pengguna.pages.supervisi.log-actual',
            compact('pageTitle', 'baseline', 'supervisi', 'logs', 'breadcrumb')
        );
    }

    public function actualActivityForm($id, $slug)
    {
        $baseline = TranBaseline::findOrFail($id);
        $actual_volume_old = 0;
        $action = 'adddate';
        if ($baseline->activity_id == 23) {
            $action = 'addbast';
        }
        if ($baseline->activity_id >= 1 && $baseline->activity_id <= 19) {
            $sumActualVolume =  $baseline->actual_volume;
        } else if ($baseline->activity_id == 20) {
            $sumActualVolume = LogActual::where("project_id", $baseline->project_id)->where('approval_waspang',  'approve')->where("tran_baseline_id", $baseline->id)->sum('actual_volume');
        } else if ($baseline->activity_id == 21) {
            $sumActualVolume = LogActual::where("project_id", $baseline->project_id)->where('approval_tim_ut',  'approve')->where("tran_baseline_id", $baseline->id)->sum('actual_volume');
        } else {
            $sumActualVolume = 0;
        }

        $actual_volume_old = (int) $sumActualVolume;

        $pageTitle  = $baseline->list_activity;
        $breadcrumb = [
            'Form Actual',
            $baseline->project->lop_site_id
        ];
        return view(
            'pengguna.pages.supervisi.form-actual',
            compact('pageTitle', 'baseline', 'actual_volume_old', 'breadcrumb', 'action')
        );
    }

    public function actualActivityAddDate(Request $request)
    {
        $request->validate(
            [
                'file.*' => 'required|mimes:jpg,png,zip,rar,pdf,doc,docx,xlsx,csv,mp4,webm|max:25000',
                'actual_volume' => 'required',
                'actual_status' => 'required',
                'pending_item' => $request->filled('pending_item') ? 'required' : '',
            ],
            [
                'actual_volume.required' => 'Actual Volume tidak boleh kosong',
                'actual_status.required' => 'Actual Status tidak boleh kosong',
                'file.required' => 'Evident tidak boleh kosong.',
                'file.mimes' => 'Evident yang diizinkan masuk (jpg,png,zip,rar,pdf,doc,docx,xlsx,csv).',
                'file.max' => 'Ukuran Evident tidak boleh lebih dari 25 MB.',
            ]
        );

        // Get all uploaded files
        $files = $request->file('file');

        // Create an array to store file names
        $filenames = [];

        // Loop through each uploaded file
        foreach ($files as $file) {

            // Generate unique name for file
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            // Move the uploaded file to storage
            $file->move('uploads/evident', $filename);

            // Add the filename to array
            $filenames[] = $filename;
        }

        // Join all filenames with comma as delimiter
        $filesString = implode(',', $filenames);

        //INITIAL VARIABEL REQUEST
        $baseline_id =  $request->baseline_id;
        $actual_status = $request->actual_status;
        $actual_message = $request->actual_message;
        $actual_kendala = $request->actual_kendala;
        $actual_finish_verifikasi = null;
        $actual_durasi_verifikasi = null;
        $plan_golive = null;
        $status_const = 'PREPARING';

        //DARI TABEL BASELINE
        $baseline = TranBaseline::findOrFail($request->baseline_id);
        $actual_volume = (int) $baseline->actual_volume + (int) $request->actual_volume;
        $actual_start =  $baseline->actual_start;
        $actual_finish = null;
        $actual_durasi = null;


        //CARI TANGGAL START
        if ($baseline->actual_start) {
            $actual_start =  $baseline->actual_start;
        } else {
            $actual_start = date('Y-m-d');
        }

        //CARI STATUS DOC
        if ($request->activity_id >= 1 && $request->activity_id <= 21) {
            $status_doc = 'KONSTRUKSI';
        } else if ($request->activity_id >= 22 && $request->activity_id <= 23) {
            $status_doc = 'ADMINISTRASI';
        } else {
            $status_doc = '';
        }

        //CARI ACTUAL PROGRESS
        if ($actual_status == 'belum') {
            $actual_progress = ($actual_volume / $baseline->volume) * 100;
            $actual_progress = Round($actual_progress, 1);
            if ($actual_progress >= 100) {
                $actual_progress = 90;
            }
            $actual_task = 'NEED UPDATED';
        } else {
            $actual_finish = date('Y-m-d');
            $actual_task = '';
            $actual_progress = 100;
            $start = strtotime($actual_start);
            $finish = strtotime($actual_finish);
            $jarak = $finish - $start;
            $actual_durasi = $jarak / 60 / 60 / 24;
            $actual_durasi = $actual_durasi + 1;
        }

        //CARI PROGRESS BOBOT
        $progress_bobot =  ($actual_progress / 100) * $baseline->bobot;
        $progress_bobot =  Round($progress_bobot, 1);

        // ACTIVITY PREPARING - TERMINASI / JOINTING TIDAK VERIFIKASI WASPANG
        if ($request->activity_id >= 0 && $request->activity_id <= 19) {
            $actual_task = 'APPROVED';
            $actual_finish_verifikasi = $actual_finish;
            $actual_durasi_verifikasi = $actual_durasi;
            if ($actual_status == 'belum') {
                $actual_task = 'NEED UPDATED';
                $actual_finish_verifikasi = null;
                $actual_durasi_verifikasi = null;
            }
        } else if ($request->activity_id == 20) {
            $actual_task = 'NEED APPROVED WASPANG';
            $actual_finish_verifikasi = null;
            $actual_durasi_verifikasi = null;
        } else if ($request->activity_id == 21) {
            $actual_task = 'NEED APPROVED TIM UT';
            $actual_finish_verifikasi = null;
            $actual_durasi_verifikasi = null;
        } else {
            $actual_task = null;
            $actual_finish_verifikasi = $actual_finish;
            $actual_durasi_verifikasi = $actual_durasi;
        }

        try {
            DB::beginTransaction();

            //SIMPAN KE LOG ACTUAL
            $logActual = LogActual::create([
                'project_id' => $baseline->project_id,
                'tran_baseline_id' => $baseline->id,
                'actual_volume' => $request->actual_volume,
                'actual_progress' =>  $actual_progress,
                'actual_evident' => $filesString,
                'actual_status' => $actual_status,
                'actual_message' => $actual_message,
                'actual_kendala' => $actual_kendala,
                'progress_bobot' => $progress_bobot,
                'actual_start' => $actual_start,
                'actual_finish' => $actual_finish,
                'actual_durasi' => $actual_durasi,
            ]);

            // UPDATE ACTUAL DI TRANSBASELINE
            TranBaseline::where("id", $baseline->id)
                ->update([
                    'actual_status' => $actual_status,
                    'actual_start' => $actual_start,
                    'actual_finish' => $actual_finish_verifikasi,
                    'actual_task' =>  $actual_task,
                    'actual_progress' =>  $actual_progress,
                    'actual_volume' =>  $actual_volume,
                    'actual_durasi' => $actual_durasi_verifikasi,
                    'actual_message' => $actual_message,
                    'actual_kendala' => $actual_kendala,
                    'pending_item' => $request->pending_item,
                ]);

            if (cek_commisioning_tes($baseline->project_id) == 1) {
                $status_const = 'SELESAI CT';
            }
            if (cek_all_installasi($baseline->project_id) == cek_all_installasi_finish($baseline->project_id) && cek_commisioning_tes($baseline->project_id) == 0) {
                $status_const = 'INSTALL DONE';
            }
            if (cek_all_installasi($baseline->project_id) > cek_all_installasi_finish($baseline->project_id)) {
                $status_const = 'INSTALASI';
            }
            if (cek_all_delivery($baseline->project_id) == cek_all_delivery_finish($baseline->project_id) && cek_all_installasi_finish($baseline->project_id) == 0) {
                $status_const = 'MATERIAL DELIVERY ON SITE';
            }
            if (cek_all_delivery($baseline->project_id) > cek_all_delivery_finish($baseline->project_id)) {
                $status_const = 'MATERIAL DELIVERY';
            }
            if (cek_all_delivery_finish($baseline->project_id) == 0) {
                $status_const = 'PREPARING';
            }


            //     echo $status_const;
            // die();

            //UPDATE SUPERVISI
            $task = 'PROGRESS ' . $status_const;
            if ($actual_task == 'NEED APPROVED WASPANG') {
                $task = $actual_task;
            }
            if ($actual_task == 'NEED APPROVED TIM UT') {
                $task = $actual_task;
            }
            $today = date('Y-m-d');
            $tambah_hari = 7;
            $plan_finish_const = $baseline->plan_start;
            $sumPlanBobot = 0;
            if ($plan_finish_const <= $today) {
                $sumPlanBobot = TranBaseline::where("project_id", $baseline->project_id)->where('activity_id', '<=', $request->activity_id)->sum('bobot');
            }
            $sum_selesai = TranBaseline::where("project_id", $baseline->project_id)->where("actual_progress", 100)->sum('bobot');
            $sum_belum = TranBaseline::where("project_id", $baseline->project_id)->whereBetween('actual_progress', [1, 99])->sum('progress_bobot');

            if ($status_const == 'INSTALL DONE') {
                $plan_golive = date('Y-m-d', strtotime($today . ' + ' . $tambah_hari . ' days'));
            }
            TranSupervisi::where("project_id", $baseline->project_id)
                ->update([
                    'status_const' => $status_const,
                    'status_doc' => $status_doc,
                    'progress_plan' => $sumPlanBobot,
                    'progress_actual' =>  $sum_selesai + $sum_belum,
                    'remarks' => $actual_message,
                    'kendala' => $actual_kendala,
                    'task' => $task,
                    'plan_golive' => $plan_golive
                ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // melakukan sesuatu dengan error handling, seperti log atau memberikan pesan error ke user
            $supervisi = TranSupervisi::where("project_id", $baseline->project_id)->first();

            return redirect()->route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)])->with(['error' => 'Update Actual #' . $baseline->list_activity . ' Gagal, Terjadi kesalahan sistem. Pesan error: ' . $e->getMessage()]);
        }


        $supervisi = TranSupervisi::where("project_id", $baseline->project_id)->first();
        return redirect()->route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)])->with(['success' => 'Update Actual #' . $baseline->list_activity . ' Berhasil']);
    }

    public function actualActivityAddBast(Request $request)
    {
        $request->validate(
            [
                'file' => 'required|mimes:jpg,png,zip,rar,pdf,doc,docx,xlsx,csv,sql|max:25000',
            ],
            [
                'file.required' => 'Evident tidak boleh kosong.',
                'file.mimes' => 'Evident yang diizinkan masuk (jpg,png,zip,rar,pdf,doc,docx,xlsx,csv,sql).',
                'file.max' => 'Ukuran Evident tidak boleh lebih dari 25 MB.',
            ]
        );
        // menangkap file
        $file = $request->file('file');
        // membuat nama file unik
        $nama_file = now()->timestamp . '.' . $file->getClientOriginalExtension();
        // upload ke folder public
        $file->move('uploads/evident', $nama_file);
        // File path
        $filepath = 'evident/' . $nama_file;

        $baseline = TranBaseline::where('id', $request->baseline_id)->first();
        TranBaseline::where("id", $request->baseline_id)
            ->update([
                'actual_evident' => $filepath,
                'actual_message' => $request->actual_message,
                'actual_kendala' => $request->actual_kendala,
            ]);
        TranSupervisi::where("project_id", $baseline->project_id)
            ->update([
                'task' => 'SEMUA ACTUAL ACTIVITY SELESAI',
                'file_doc_bast' => $filepath,
                'remarks' => $request->actual_message,
                'kendala' => $request->actual_kendala,
            ]);
        $supervisi = TranSupervisi::where("project_id", $baseline->project_id)->first();
        return redirect()->route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)])->with(['success' => 'Update Actual #' . $baseline->list_activity . ' Berhasil']);
    }

    public function actualActivityWaspang(Request $request)
    {
        //initial variabel
        $baseline_id = $request->baseline_id;
        $activity_id = $request->activity_id;
        $approval_waspang = $request->approval_waspang;
        $user_id =  getUser()->id;
        $log = LogActual::where(
            'tran_baseline_id',
            $baseline_id
        )->latest()->first();
        $actual_progress = $log->actual_progress;
        $progress_bobot = $log->progress_bobot;
        $actual_volume = $log->actual_volume;
        $baseline = TranBaseline::where('id', $baseline_id)->first();
        if ($baseline->pending_item == 'YA') {
            $task = 'Status "PENDING ITEM" selesaikan Pending Item untuk melanjutkan Actual Selanjutnya';
        } else {
            $task = 'silahkan melanjutkan Actual Selanjutnya';
        }

        if ($approval_waspang == 'REJECTED') {
            LogActual::where("tran_baseline_id", $baseline_id)->where('approval_waspang', NULL)
                ->update([
                    'approval_waspang' => $approval_waspang,
                    'approval_message' =>  $request->approval_message,
                    'waspang_by' => $user_id
                ]);
            TranBaseline::where("id", $baseline_id)
                ->update([
                    'approval_waspang' => $approval_waspang,
                    'approval_message' =>  $request->approval_message,
                    'actual_progress' =>  0,
                    'progress_bobot' => 0,
                    'actual_volume' => 0,
                    'actual_task' =>  'REJECTED',
                    'waspang_by' => $user_id
                ]);
            TranSupervisi::where("project_id", $baseline->project_id)
                ->update([
                    'task' => 'Rejected Waspang, catatan: "' . $request->approval_message . '", silahkan laporkan kembali CT , '
                ]);
        } else {
            $actual_finish = date('Y-m-d');
            $start = strtotime($baseline->actual_start);
            $finish = strtotime($actual_finish);

            $jarak = $finish - $start;
            $actual_durasi = $jarak / 60 / 60 / 24;
            $actual_durasi = $actual_durasi + 1;
            LogActual::where("tran_baseline_id", $baseline_id)->where('approval_waspang', NULL)
                ->update([
                    'approval_waspang' => $approval_waspang,
                    'approval_message' =>  $request->approval_message,
                    'waspang_by' => $user_id
                ]);
            TranBaseline::where("id", $baseline_id)
                ->update([
                    'approval_waspang' => $approval_waspang,
                    'approval_message' =>  $request->approval_message,
                    'actual_finish' =>  date('Y-m-d'),
                    'actual_durasi' => $actual_durasi,
                    'actual_progress' =>  100,
                    'progress_bobot' =>  $progress_bobot,
                    'actual_volume' =>  $actual_volume,
                    'actual_task' =>  'APPROVED',
                    'waspang_by' => $user_id
                ]);
            //update dokumen di supervisi
            $actual_progress_const = 100 * $baseline->bobot / 100;
            TranSupervisi::where("project_id", $baseline->project_id)
                ->update([
                    'status_const' => 'SELESAI CT',
                    'status_doc' => 'KONSTRUKSI',
                    'progress_const' => $actual_progress_const,
                    'tgl_selesai_ct' => date('Y-m-d'),
                    'task' => 'Appoval Waspang, status: "SELESAI CT", '. $task .', '
                ]);
        }
        $supervisi = TranSupervisi::where("project_id", $baseline->project_id)->first();
        return redirect()->route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)])->with(['success' => 'Update Actual #' . $baseline->list_activity . ' Berhasil']);
    }

    public function actualActivityUt(Request $request)
    {
        //initial variabel
        $baseline_id = $request->baseline_id;
        $activity_id = $request->activity_id;
        $approval_tim_ut = $request->approval_tim_ut;
        $user_id =  getUser()->id;
        $log = LogActual::where(
            'tran_baseline_id',
            $baseline_id
        )->latest()->first();
        $actual_progress = $log->actual_progress;
        $progress_bobot = $log->progress_bobot;
        $actual_volume = $log->actual_volume;
        $baseline = TranBaseline::where('id', $baseline_id)->first();
        if ($baseline->pending_item == 'YA') {
            $task = 'Status "PENDING ITEM" selesaikan Pending Item untuk melanjutkan Actual Selanjutnya';
        } else {
            $task = 'silahkan melanjutkan Actual Selanjutnya';
        }
        $administrasi = TranAdministrasi::where('project_id', $baseline->project_id)->first();
        if ($approval_tim_ut == 'REJECTED') {
            LogActual::where("tran_baseline_id", $baseline_id)->where('approval_tim_ut', NULL)
                ->update([
                    'approval_tim_ut' => $approval_tim_ut,
                    'approval_message' =>  $request->approval_message,
                    'tim_ut_by' => $user_id
                ]);
            TranBaseline::where("id", $baseline_id)
                ->update([
                    'approval_tim_ut' => $approval_tim_ut,
                    'approval_message' =>  $request->approval_message,
                    'actual_progress' =>  0,
                    'progress_bobot' => 0,
                    'actual_volume' => 0,
                    'actual_task' =>  'REJECTED',
                    'tim_ut_by' => $user_id
                ]);
            TranSupervisi::where("project_id", $baseline->project_id)
                ->update([
                    'task' => 'Rejected TIM UT, catatan: "' . $request->approval_message . '", silahkan laporkan kembali Pelaksanaan UT , '
                ]);
        } else {
            $actual_finish = date('Y-m-d');
            $start = strtotime($baseline->actual_start);
            $finish = strtotime($actual_finish);

            $jarak = $finish - $start;
            $actual_durasi = $jarak / 60 / 60 / 24;
            $actual_durasi = $actual_durasi + 1;
            LogActual::where("tran_baseline_id", $baseline_id)->where('approval_tim_ut', NULL)
                ->update([
                    'approval_tim_ut' => $approval_tim_ut,
                    'approval_message' =>  $request->approval_message,
                    'tim_ut_by' => $user_id
                ]);
            TranBaseline::where("id", $baseline_id)
                ->update([
                    'approval_tim_ut' => $approval_tim_ut,
                    'approval_message' =>  $request->approval_message,
                    'actual_finish' =>  date('Y-m-d'),
                    'actual_durasi' => $actual_durasi,
                    'actual_progress' =>  100,
                    'progress_bobot' =>  $progress_bobot,
                    'actual_volume' =>  $actual_volume,
                    'actual_task' =>  'APPROVED',
                    'tim_ut_by' => $user_id
                ]);
            TranBaseline::where("activity_id", 22)->where('project_id', $baseline->project_id)
                ->update([
                    'actual_start' =>  date('Y-m-d'),

                ]);
            //update dokumen di supervisi
            $actual_progress_const = 100 * $baseline->bobot / 100;
            TranSupervisi::where("project_id", $baseline->project_id)
                ->update([
                    'status_const' => 'SELESAI UT',
                    'status_doc' => 'ADMINISTRASI',
                    'progress_const' => $actual_progress_const,
                    'tgl_selesai_ut' => date('Y-m-d'),
                    'task' => 'Appoval TIM UT, status: "SELESAI UT" , '.$task.' '
                ]);
            TranAdministrasi::where("project_id", $baseline->project_id)
                ->update([
                    'status_doc' => 'PEMBUATAN DOKUMEN',
                    'posisi_doc' => 'MITRA AREA'
                ]);
            //SIMPAN KE LOG ACTUAL
            LogAdministrasi::create([
                'tran_administrasi_id' => $administrasi->id,
                'status_doc' => 'PEMBUATAN DOKUMEN',
                'posisi_doc' => 'MITRA AREA',
            ]);
        }
        $supervisi = TranSupervisi::where("project_id", $baseline->project_id)->first();
        return redirect()->route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)])->with(['success' => 'Apprive Actual #' . $baseline->list_activity . ' Berhasil']);
    }

    public function actualActivityPendingItem(Request $request)
    {
        $request->validate(
            [
                'pending_item' => 'required',
                'actual_message' => 'required',
            ],
            [
                'pending_item.required' => 'Pending Item tidak boleh kosong',
                'actual_message.required' => 'Remarks tidak boleh kosong',
            ]
        );

        //initial variabel
        $baseline_id = $request->baseline_id;
        $activity_id = $request->activity_id;
        $pending_item = $request->pending_item;
        $actual_message = $request->actual_message;
        $user_id =  getUser()->id;
        if ($pending_item == 'YA') {
            $task = 'Status "PENDING ITEM" selesaikan Pending Item untuk melanjutkan Actual Selanjutnya';
        } else {
            $task = 'Status "PENDING ITEM SELESAI" silahkan melanjutkan Actual Selanjutnya';
        }
        $log = LogActual::where(
            'tran_baseline_id',
            $baseline_id
        )->latest()->first();

        $baseline = TranBaseline::where('id', $baseline_id)->first();

        LogActual::where("id", $log->id)
            ->update([
                'actual_message' =>  $actual_message,
            ]);
        TranBaseline::where("id", $baseline_id)
            ->update([
                'pending_item' => $pending_item,
            ]);
        TranSupervisi::where("project_id", $baseline->project_id)
            ->update([
                'task' => $task
            ]);

        $supervisi = TranSupervisi::where("project_id", $baseline->project_id)->first();
        return redirect()->route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)])->with(['success' => 'Update Actual #' . $baseline->list_activity . ' Berhasil']);
    }
}
