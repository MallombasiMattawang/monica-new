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
        $cek_all_delivery = TranBaseline::select('actual_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereBetween('activity_id', [3, 9])->count();

        $cek_all_delivery_finish = TranBaseline::select('actual_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereNotNull('actual_finish')
            ->whereBetween('activity_id', [3, 9])->count();

        $cek_all_installasi = TranBaseline::select('actual_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereBetween('activity_id', [10, 19])->count();

        $cek_all_installasi_finish = TranBaseline::select('actual_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereNotNull('actual_finish')
            ->where('actual_finish', '<>', '')
            ->whereBetween('activity_id', [10, 19])->count();

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
        //$log_cek = LogActual::where("tran_baseline_id", $id)->first();
        $logs = LogActual::where("tran_baseline_id", $id)->get();

        $pageTitle  = $baseline->list_activity;
        $breadcrumb = [
            'Log Actual',
            $baseline->project->lop_site_id
        ];
        return view(
            'pengguna.pages.supervisi.log-actual',
            compact('pageTitle', 'baseline', 'logs', 'breadcrumb')
        );
    }

    public function actualActivityForm($id, $slug)
    {
        $baseline = TranBaseline::findOrFail($id);
        $actual_volume_old = 0;
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
            compact('pageTitle', 'baseline', 'actual_volume_old', 'breadcrumb')
        );
    }

    public function actualActivityAddDate(Request $request)
    {
        $validatedData = $request->validate(
            [
                'file' => 'required|mimes:jpg,png,zip,rar,pdf,doc,docx,xlsx,csv,sql|max:25000',
                'actual_volume' => 'required',
                'actual_status' => 'required'
            ],
            [
                'actual_volume.required' => 'Actual Volume tidak boleh kosong',
                'actual_status.required' => 'Actual Status tidak boleh kosong',
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

        //INITIAL VARIABEL REQUEST
        $baseline_id =  $request->baseline_id;
        $actual_status = $request->actual_status;
        $actual_message = $request->actual_message;
        $actual_kendala = $request->actual_kendala;

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
        // CARI STATUS CONST
        if ($request->activity_id >= 1 && $request->activity_id <= 2) {
            $status_const = 'PREPARING';
        } else if ($request->activity_id >= 3 && $request->activity_id <= 9) {
            $status_const = 'MATERIAL DELIVERY';
            $cek_const = TranBaseline::select('actual_start, actual_finish')
                ->where('project_id', $baseline->project_id)
                ->whereBetween('activity_id', [3, 9])->count();
            $cek_const_actual = TranBaseline::select('actual_start, actual_finish')
                ->where('project_id', $baseline->project_id)
                ->whereNotNull('actual_start')
                ->whereBetween('activity_id', [3, 9])->count();
            if ($cek_const_actual == $cek_const) {
                $status_const = "MATERIAL DELIVERY ON SITE";
            }
        } else if ($request->activity_id >= 10 && $request->activity_id <= 20) {
            $status_const = 'INSTALASI';
        } else if ($request->activity_id == 21) {
            $status_const = 'SELESAI CT';
        } else if ($request->activity_id == 22) {
            $status_const = 'SELESAI UT';
        } else if ($request->activity_id == 23) {
            $status_const = 'REKON';
        } else {
            $status_const = '';
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
        if ($request->activity_id >= 1 && $request->activity_id <= 19) {
            $actual_task = 'APPROVED';
            if ($actual_status == 'belum') {
                $actual_task = 'NEED UPDATED';
            }
        } else if ($request->activity_id == 20) {
            $actual_task = 'NEED APPROVED WASPANG';
            $actual_finish_verifikasi = '';
            $actual_durasi_verifikasi = '';
        } else if ($request->activity_id == 21) {
            $actual_task = 'NEED APPROVED TIM UT';
            $actual_finish_verifikasi = '';
            $actual_durasi_verifikasi = '';
        } else {
            $actual_task = '';
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
                'actual_evident' => $filepath,
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
                ]);

            //UPDATE SUPERVISI
            $today = date('Y-m-d');
            $plan_finish_const = $baseline->plan_start;
            $sumPlanBobot = 0;
            if ($plan_finish_const <= $today) {
                $sumPlanBobot = TranBaseline::where("project_id", $baseline->project_id)->where('activity_id', '<=', $request->activity_id)->sum('bobot');
            }
            $sum_selesai = TranBaseline::where("project_id", $baseline->project_id)->where("actual_progress", 100)->sum('bobot');
            $sum_belum = TranBaseline::where("project_id", $baseline->project_id)->whereBetween('actual_progress', [1, 99])->sum('progress_bobot');
            TranSupervisi::where("project_id", $baseline->project_id)
                ->update([
                    'status_const' => $status_const,
                    'status_doc' => $status_doc,
                    'progress_plan' => $sumPlanBobot,
                    'progress_actual' =>  $sum_selesai + $sum_belum,
                    'remarks' => $actual_message
                ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // melakukan sesuatu dengan error handling, seperti log atau memberikan pesan error ke user
            $supervisi = TranSupervisi::where("project_id", $baseline->project_id)->first();

            return redirect()->route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)])->with(['error' => 'Update Actual #' . $baseline->list_activity . ' Gagal']);
        }


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
            //update dokumen di supervisi
            $actual_progress_const = 100 * $baseline->bobot / 100;
            TranSupervisi::where("project_id", $baseline->project_id)
                ->update([
                    'status_const' => 'SELESAI UT',
                    'status_doc' => 'ADMINISTRASI',
                    'progress_const' => $actual_progress_const,
                    'tgl_selesai_ut' => date('Y-m-d'),
                ]);
        }
        $supervisi = TranSupervisi::where("project_id", $baseline->project_id)->first();
        return redirect()->route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)])->with(['success' => 'Apprive Actual #' . $baseline->list_activity . ' Berhasil']);

       
    }
}
