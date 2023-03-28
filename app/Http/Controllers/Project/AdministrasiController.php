<?php

namespace App\Http\Controllers\Project;

use Illuminate\Support\Str;
use App\Models\TranBaseline;
use Illuminate\Http\Request;
use App\Models\TranSupervisi;
use App\Models\LogAdministrasi;
use App\Models\TranAdministrasi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdministrasiController extends Controller
{
    public function administrasiActivity($id, $slug)
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
            return abort(403);
        }
        $supervisi =  TranSupervisi::whereRaw("$user AND id = $id")->first();
        $pageTitle  = $supervisi->project_name;
        $lists = TranBaseline::where("project_id", $supervisi->project_id)->whereIn('activity_id', [22, 23])->get();
        $baseline = TranBaseline::where('project_id', $supervisi->project_id)->where('activity_id', 22)->first();
        $administrasi = TranAdministrasi::where('project_id', $supervisi->project_id)->first();
        //$log_administrasi = LogAdministrasi::where('TranAdministrasi', $administrasi->id)->where('activity_id', 22)->first();

        return view(
            'pengguna.pages.supervisi.administrasi-activity',
            compact(
                'pageTitle',
                'lists',
                'baseline',
                'administrasi'
            )
        );
    }

    public function administrasiActivityForm($id, $cat)
    {
        $baseline = TranBaseline::findOrFail($id);
        $administrasi = TranAdministrasi::where('project_id', $baseline->project_id)->first();

        $pageTitle  = $baseline->list_activity;
        $breadcrumb = [
            'Form Administrasi',
            $baseline->project->lop_site_id
        ];
        if ($cat == 'docToWitel') {
            $send = 'Pengiriman Dokumen ke Witel';
        } elseif ($cat == 'docToRegional') {
            $send = 'Pengiriman Dokumen ke Regional';
        } elseif ($cat == 'verifikasiInternal') {
            $send = 'Verifikasi Internal';
        } elseif ($cat == 'docBaRekon') {
            $send = 'Pengiriman BA Rekon';
        } else {
            return abort(403);
        }
        return view(
            'pengguna.pages.supervisi.form-administrasi',
            compact('pageTitle', 'baseline', 'cat', 'send', 'breadcrumb', 'administrasi')
        );
    }

    public function docToWitel(Request $request)
    {
        $request->validate(
            [
                'docToWitel' => 'required|mimes:pdf|max:25000',

            ],
            [
                'docToWitel.required' => 'Dokumen tidak boleh kosong.',
                'docToWitel.mimes' => 'Dokumen yang diizinkan masuk hanya (pdf).',
                'docToWitel.max' => 'Ukuran Dokumen tidak boleh lebih dari 25 MB.',
            ]
        );
        // menangkap file 
        $file = $request->file('docToWitel');
        // membuat nama file unik
        $nama_file = now()->timestamp . '.' . $file->getClientOriginalExtension();
        // upload ke folder public
        $file->move('uploads/evident', $nama_file);
        // File path
        $filepath = 'evident/' . $nama_file;

        //INITIAL VARIABEL REQUEST
        $baseline = TranBaseline::findOrFail($request->baseline_id);
        $administrasi = TranAdministrasi::where('project_id', $baseline->project_id)->first();

        try {
            DB::beginTransaction();

            //SIMPAN KE LOG ADMINISTRASI
            LogAdministrasi::create([
                'tran_administrasi_id' => $administrasi->id,
                'status_doc' => 'VERIFIKASI DOKUMEN',
                'posisi_doc' => 'WITEL',
                'file_doc' =>  $filepath,
                'remarks' => $request->actual_message,
                'status_verfy' => 'VERIFIKASI WITEL',
            ]);

            // UPDATE ACTUAL DI TRANSADMINISTRASI    
            TranAdministrasi::where("id", $administrasi->id)
                ->update([
                    'status_doc' => 'VERIFIKASI DOKUMEN',
                    'posisi_doc' => 'WITEL',
                    'file_doc' => $filepath,
                    'remarks' =>  $request->actual_message,
                    'status_verfy' =>  'VERIFIKASI WITEL'
                ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // melakukan sesuatu dengan error handling, seperti log atau memberikan pesan error ke user           
            return redirect()->back()->with(['error' => 'Update Dokumen Gagal']);
        }
        $supervisi = TranSupervisi::where("project_id", $baseline->project_id)->first();
        return redirect()->route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)])->with(['success' => 'Update Administrasi #' . $baseline->list_activity . ' Berhasil']);
    }
    public function docToRegional(Request $request)
    {
        $request->validate(
            [
                'docToRegional' => 'required|mimes:pdf|max:25000',

            ],
            [
                'docToRegional.required' => 'Dokumen tidak boleh kosong.',
                'docToRegional.mimes' => 'Dokumen yang diizinkan masuk hanya (pdf).',
                'docToRegional.max' => 'Ukuran Dokumen tidak boleh lebih dari 25 MB.',
            ]
        );
        // menangkap file 
        $file = $request->file('docToRegional');
        // membuat nama file unik
        $nama_file = now()->timestamp . '.' . $file->getClientOriginalExtension();
        // upload ke folder public
        $file->move('uploads/evident', $nama_file);
        // File path
        $filepath = 'evident/' . $nama_file;

        //INITIAL VARIABEL REQUEST
        $baseline = TranBaseline::findOrFail($request->baseline_id);
        $administrasi = TranAdministrasi::where('project_id', $baseline->project_id)->first();

        try {
            DB::beginTransaction();

            //SIMPAN KE LOG ADMINISTRASI
            LogAdministrasi::create([
                'tran_administrasi_id' => $administrasi->id,
                'status_doc' => 'VERIFIKASI INTERNAL',
                'posisi_doc' => 'MITRA REGIONAL',
                'file_doc' =>  $filepath,
                'remarks' => $request->actual_message,
                'status_verfy' => 'VERIFIKASI INTERNAL',
            ]);

            // UPDATE ACTUAL DI TRANSADMINISTRASI    
            TranAdministrasi::where("id", $administrasi->id)
                ->update([
                    'status_doc' => 'VERIFIKASI INTERNAL',
                    'posisi_doc' => 'MITRA REGIONAL',
                    'file_doc' => $filepath,
                    'remarks' =>  $request->actual_message,
                    'status_verfy' =>  'VERIFIKASI INTERNAL'
                ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // melakukan sesuatu dengan error handling, seperti log atau memberikan pesan error ke user           
            return redirect()->back()->with(['error' => 'Update Dokumen Gagal']);
        }
        $supervisi = TranSupervisi::where("project_id", $baseline->project_id)->first();
        return redirect()->route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)])->with(['success' => 'Update Administrasi #' . $baseline->list_activity . ' Berhasil']);
    }
    public function verifikasiInternal(Request $request)
    {
        $request->validate(
            [
                'status_verfy' => 'required',
                'actual_message' => 'required',

            ],
            [
                'status_verfy.required' => 'Verifikasi tidak boleh kosong.',
                'actual_message.required' => 'Remarks tidak boleh kosong.',
            ]
        );
        //INITIAL VARIABEL REQUEST
        $baseline = TranBaseline::findOrFail($request->baseline_id);
        $administrasi = TranAdministrasi::where('project_id', $baseline->project_id)->first();
        if ($request->status_verfy == 'APPROVAL INTERNAL') {
            $status_doc = 'VERIFIKASI DOKUMEN';
            $posisi_doc = 'TELKOM REGIONAL';
            $status_verfy = $request->status_verfy;
        } elseif ($request->status_verfy == 'REJECTED INTERNAL') {
            $status_doc = 'REVISI DOKUMEN';
            $posisi_doc = 'MITRA AREA';
            $status_verfy = $request->status_verfy;
        } else {
            return abort(403);
        }

        try {
            DB::beginTransaction();

            //SIMPAN KE LOG ADMINISTRASI
            LogAdministrasi::create([
                'tran_administrasi_id' => $administrasi->id,
                'status_doc' => $status_doc,
                'posisi_doc' => $posisi_doc,
                'file_doc' =>  $administrasi->file_doc,
                'catatan_verifikator' => $request->actual_message,
                'status_verfy' => $status_verfy,
            ]);

            // UPDATE ACTUAL DI TRANSADMINISTRASI    
            TranAdministrasi::where("id", $administrasi->id)
                ->update([
                    'status_doc' => $status_doc,
                    'posisi_doc' => $posisi_doc,
                    'file_doc' =>  $administrasi->file_doc,
                    'catatan_verifikator' =>  $request->actual_message,
                    'status_verfy' => $status_verfy,
                ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // melakukan sesuatu dengan error handling, seperti log atau memberikan pesan error ke user           
            return redirect()->back()->with(['error' => 'Update Dokumen Gagal']);
        }
        $supervisi = TranSupervisi::where("project_id", $baseline->project_id)->first();
        return redirect()->route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)])->with(['success' => 'Update Administrasi #' . $baseline->list_activity . ' Berhasil']);
    }
    public function docBaRekon(Request $request)
    {
        $request->validate(
            [
                'docBaRekon' => 'required|mimes:pdf|max:25000',

            ],
            [
                'docBaRekon.required' => 'Dokumen tidak boleh kosong.',
                'docBaRekon.mimes' => 'Dokumen yang diizinkan masuk hanya (pdf).',
                'docBaRekon.max' => 'Ukuran Dokumen tidak boleh lebih dari 25 MB.',
            ]
        );
        // menangkap file 
        $file = $request->file('docBaRekon');
        // membuat nama file unik
        $nama_file = now()->timestamp . '.' . $file->getClientOriginalExtension();
        // upload ke folder public
        $file->move('uploads/evident', $nama_file);
        // File path
        $filepath = 'evident/' . $nama_file;

        //INITIAL VARIABEL REQUEST
        $baseline = TranBaseline::findOrFail($request->baseline_id);
        $administrasi = TranAdministrasi::where('project_id', $baseline->project_id)->first();

        try {
            DB::beginTransaction();            
            // UPDATE ACTUAL DI TRANSADMINISTRASI    
            TranAdministrasi::where("id", $administrasi->id)
                ->update([
                    'file_ba_rekon' => $filepath,
                    'remarks' =>  $request->actual_message,
                    'status_ba_rekon' =>  'VERIFIKASI TELKOM REGIONAL'
                ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // melakukan sesuatu dengan error handling, seperti log atau memberikan pesan error ke user           
            return redirect()->back()->with(['error' => 'Update Dokumen Gagal']);
        }
        $supervisi = TranSupervisi::where("project_id", $baseline->project_id)->first();
        return redirect()->route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)])->with(['success' => 'Update Administrasi #' . $baseline->list_activity . ' Berhasil']);
    }
}
