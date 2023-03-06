<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\LogActual;
use App\Models\LogPlan;
use App\Models\MstProject;
use App\Models\TranBaseline;
use App\Models\TranSupervisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ActualController extends Controller
{
    public function actualActivity($id, $slug)
    {
        $mitra_id =  getUser()->id;
        $check = TranSupervisi::where("id", $id)->where('mitra_id', $mitra_id)->exists();
        if ($check == 0) {
            return abort(404);
        }
        $supervisi = TranSupervisi::where("id", $id)->where('mitra_id', $mitra_id)->first();
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
            ->whereBetween('activity_id', [10, 19])->count();

        $cek_commisioning_tes = TranBaseline::select('actual_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereNotNull('actual_finish')
            ->where('activity_id', 20)->exists();

        $cek_ut = TranBaseline::select('actual_finish')
            ->where('project_id', $supervisi->project_id)
            ->where('approval_tim_ut', 'approve')
            ->whereNotNull('actual_finish')
            ->where('activity_id', 21)->exists();

        $cek_rekon = TranBaseline::select('actual_finish')
            ->where('project_id', $supervisi->project_id)
            ->where('actual_task', 'APPROVED')
            ->whereNotNull('actual_finish')
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
                'volume_actual' => 'required'
            ],
            [
                'volume_actual.required' => 'Volume Actual tidak boleh kosong',
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

        //INITIAL VARIABEL
        $baseline_id =  $request->baseline_id;
        $actual_status = $request->volume_actual;
        $actual_message = $request->actual_message;
        $listActivity = TranBaseline::findOrFail($request->baseline_id);
        $actual_volume = (int) $request->actual_volume_old + (int) $request->actual_volume;
         // CARI STATUS CONST
         $status_const = '';
         if ($request->activity_id >= 1 && $request->activity_id <= 2) {
             $status_const = 'PREPARING';
         }
         if ($request->activity_id >= 3 && $request->activity_id <= 9) {
             $status_const = 'MATERIAL DELIVERY';
         }
         if ($request->activity_id >= 10 && $request->activity_id <= 19) {
             $status_const = 'INSTALASI';
         }
         if ($request->activity_id == 20) {
             $status_const = 'INSTALL DONE';
         }
         if ($request->activity_id == 21) {
             $status_const = 'SELESAI CT';
         }
         if ($request->activity_id == 22) {
             $status_const = 'SELESAI UT';
         }
         if ($request->activity_id == 23) {
             $status_const = 'REKON';
         }

        if ($actual_status == 'belum') {
            $actual_progress = ($actual_volume / $listActivity->volume) * 100;
            $actual_progress = Round($actual_progress, 1);
            if ($actual_progress >= 100) {
                $actual_progress = 90;
            }
            $actual_start = date('Y-m-d');
            $actual_task = 'NEED UPDATED';
        } else {
            $actual_progress = 100;
        }



        return redirect()->back();
    }
}
