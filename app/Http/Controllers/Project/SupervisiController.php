<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\LogPlan;
use App\Models\MstProject;
use App\Models\TranBaseline;
use App\Models\TranSupervisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SupervisiController extends Controller
{
    public function index(Request $request)
    {

        //middlewareCheck(['web','mitra']);

        $insight = TRUE;
        // $insightsupervisi = supervisi::whereIn('id', [82, 22, 54, 55, 65, 66,328,148])->orderBy('jenjang', 'ASC')->get();
        $insightsupervisi = "";

        $pageTitle  = "Supervisi";
        $breadcrumb = [
            'Data Project',
            'Supervisi'
        ];

        $where = '';

        $keyword = request()->input('keyword');
        if (!empty($keyword)) {
            $where .= "AND project_name LIKE '%$keyword%' ";
        }

        $skip  = $request->input('skip');
        $take  = "20";

        $mitra_id =  getUser()->id;
        $results = TranSupervisi::whereRaw("mitra_id = '$mitra_id'  $where")
            ->skip($skip)
            ->take($take)
            ->orderBy('id', 'DESC')
            ->get();



        // return $results;

        $response = '';
        if ($request->ajax()) {

            $id = 1 + $skip;

            foreach ($results as $supervisi) {

                // $bg = ($supervisi->jenjang == "SMP") ? "bg-card-yellow" : "bg-card-red";
                $status_const = ($supervisi->status_const) ? "$supervisi->status_const" : "BELUM ADA";
                $bg = '';
                $ssStatus = '';
                $response .= '
                 <div class="col-md-4 hello" id="' . $id++ . '">
                 <div class="card">
                 <div class="card-body">
                   <h6 class="mb-1"><a href="' . route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)]) . '" class="color-600">' . $supervisi->project_name . '</a></h6>
                   <p class="text-muted">WITEL : ' . $supervisi->supervisi_witel->name . '</p>
                   
                   <div class="project-members mb-4">
                   <label class="me-2">Status :</label>
                     <span class="badge bg-success">' . $supervisi->supervisi_project->status_project . ' </span>
                     <label class="me-2">Const :</label>
                     <span class="badge bg-warning">' . $status_const . ' </span>
                     
                   </div>
                   <label class="small d-flex justify-content-between">Progress Plan ' . $supervisi->progress_plan . '% <span class="text-custom">100%</span></label>
                   <div class="progress mt-1" style="height: 3px;">
                     <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: ' . $supervisi->progress_plan . '%;"></div>
                   </div>
                   <br>
                   <label class="small d-flex justify-content-between">Progress Actual ' . $supervisi->progress_actual . '% <span class="text-custom">100%</span></label>
                   <div class="progress mt-1" style="height: 3px;">
                     <div class="progress-bar bg-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: ' . $supervisi->progress_actual . '%;"></div>
                   </div>
                 </div>
                 <div class="card-footer py-3 text-center">
                   <small>Start date: <strong>' . tgl_indo($supervisi->supervisi_project->start_date) . '</strong></small>
                   <span class="px-3">|</span>
                   <small>Finish date: <strong>' . tgl_indo($supervisi->supervisi_project->end_date) . '</strong></small>
                 </div>
               </div>
                </div>
                ';
            }



            return $response;
        }


        return view(
            'pengguna.pages.supervisi.index',
            compact('pageTitle', 'breadcrumb', 'insight', 'insightsupervisi')
        );
    }

    public function detail($id, $slug)
    {
        $profil = TranSupervisi::findOrFail($id);

        $pageTitle  = $profil->project_name;
        $breadcrumb = [
            'Supervisi',
            'Detail'
        ];
        return view(
            'pengguna.pages.supervisi.detail',
            compact('pageTitle', 'profil', 'breadcrumb')
        );
    }

    public function planActivity($id, $slug)
    {
        $mitra_id =  getUser()->id;
        $check = TranSupervisi::where("id", $id)->where('mitra_id', $mitra_id)->exists();
        if ($check == 0) {
            return abort(404);
        }
        $supervisi = TranSupervisi::where("id", $id)->where('mitra_id', $mitra_id)->first();
        $lists = TranBaseline::where("project_id", $supervisi->project_id)->get();
        $countBase = TranBaseline::where("project_id", $supervisi->project_id)->where('bobot', '>=', '1')->count();
        $sumBase = TranBaseline::where("project_id", $supervisi->project_id)->where('bobot', '>=', '1')->sum('bobot');
        $countPlan = TranBaseline::where("project_id", $supervisi->project_id)->where('plan_durasi', '>=', '1')->count();
        $sumDurasi = TranBaseline::where("project_id", $supervisi->project_id)->where('plan_durasi', '>=', '1')->sum('plan_durasi');
        $cek_preparing = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 2)
            ->first();
        $cek_material = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 9)
            ->first();
        $cek_jointing = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 19)
            ->first();
        $cek_comtes = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 20)
            ->first();
        $cek_ut = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 21)
            ->first();
        $cek_rekon = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 22)
            ->first();
        $cek_bast = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 23)
            ->first();
        $cek_all_delivery = TranBaseline::select('plan_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereBetween('activity_id', [3, 9])->count();

        $cek_all_delivery_finish = TranBaseline::select('plan_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereNotNull('plan_finish')
            ->whereBetween('activity_id', [3, 9])->count();

        $cek_all_installasi = TranBaseline::select('plan_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereBetween('activity_id', [10, 19])->count();

        $cek_all_installasi_finish = TranBaseline::select('plan_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereNotNull('plan_finish')
            ->whereBetween('activity_id', [10, 19])->count();

        $pageTitle  = $supervisi->project_name;

        return view(
            'pengguna.pages.supervisi.plan-activity',
            compact(
                'pageTitle',
                'supervisi',
                'lists',
                'countBase',
                'sumBase',
                'countPlan',
                'sumDurasi',
                'cek_preparing',
                'cek_material',
                'cek_jointing',
                'cek_comtes',
                'cek_ut',
                'cek_rekon',
                'cek_bast',
                'cek_all_delivery',
                'cek_all_delivery_finish',
                'cek_all_installasi',
                'cek_all_installasi_finish',
            )
        );
    }

    public function planActivityAddDate(Request $request)
    {
        $baseline = TranBaseline::where('id', $request->baseline_id)->first();
        $project = MstProject::where('id', $baseline->project_id)->first();
        if ($request->plan_finish >= $request->plan_start && $request->plan_finish <=  $project->end_date) {
            //delete di logPlan
            LogPlan::where('baseline_id', $baseline->id)->delete();

            // udpated plan
            TranBaseline::where("id", $request->baseline_id)
                ->update([
                    'plan_start' => $request->plan_start,
                    'plan_finish' => $request->plan_finish,
                    'plan_durasi' => $request->plan_durasi
                ]);
            $start = $request->plan_start;
            $log_bobot = $baseline->bobot / $request->plan_durasi;

            for ($i = 1; $i <= $request->plan_durasi; $i++) {
                $logPlan = LogPlan::create([
                    'project_id' => $baseline->project_id,
                    'baseline_id' => $baseline->id,
                    'log_date' =>  $start,
                    'log_bobot' =>  $log_bobot
                ]);
                $logPlan->save();
                $start = date('Y-m-d', strtotime('+1 day', strtotime($start))); //looping tambah 1 date
            }

            if ($baseline->activity_id == 2 || $baseline->activity_id == 9 || $baseline->activity_id == 19 || $baseline->activity_id == 20 || $baseline->activity_id == 21 || $baseline->activity_id == 22 || $baseline->activity_id == 23) {
                TranBaseline::where("id", $request->baseline_id + 1)
                    ->update([
                        'plan_start' => $request->plan_finish,
                    ]);

                TranBaseline::where("project_id", $baseline->project_id)->where('id', '>', $request->baseline_id)
                    ->update([
                        //'plan_start' => null,
                        'plan_finish' => null,
                        'plan_durasi' => null
                    ]);
                TranBaseline::where("project_id", $baseline->project_id)->where('id', '>', $request->baseline_id + 1)
                    ->update([
                        'plan_start' => null,
                        'plan_finish' => null,
                        'plan_durasi' => null
                    ]);
            }
            //  }
            //ketika ada update 

            return response()->json(['success' => 'update plan berhasil']);
        } else {
            return response()->json(['error' => 'Tanggal finish tidak boleh lebih kecil dari tanggal start atau lewat ketentuan tanggal finish baseline ' . tgl_indo($project->end_date) . '']);
        }

        return redirect()->back();
    }

    public function planActivitySubmit(Request $request)
    {
        MstProject::where("id", $request->id)
            ->update([
                'status_plan' => '1',
            ]);

        TranSupervisi::where("project_id", $request->id)
            ->update([
                'task' => 'PENGISIAN ACTUAL',
            ]);
        admin_success('Submit Plan Success!');
        admin_toastr('Submit Plan Success!', 'success');
        return back();
    }

    /**================================================= ACTUAL ACTIVITY======================================================== */
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
        $sumDurasi = TranBaseline::where("project_id", $supervisi->project_id)->where('plan_durasi', '>=', '1')->sum('plan_durasi');
        $cek_preparing = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 2)
            ->first();
        $cek_material = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 9)
            ->first();
        $cek_jointing = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 19)
            ->first();
        $cek_comtes = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 20)
            ->first();
        $cek_ut = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 21)
            ->first();
        $cek_rekon = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 22)
            ->first();
        $cek_bast = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 23)
            ->first();
        $cek_all_delivery = TranBaseline::select('plan_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereBetween('activity_id', [3, 9])->count();

        $cek_all_delivery_finish = TranBaseline::select('plan_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereNotNull('plan_finish')
            ->whereBetween('activity_id', [3, 9])->count();

        $cek_all_installasi = TranBaseline::select('plan_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereBetween('activity_id', [10, 19])->count();

        $cek_all_installasi_finish = TranBaseline::select('plan_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereNotNull('plan_finish')
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
                'supervisi',
                'lists',
                'countBase',
                'sumBase',
                'countPlan',
                'sumDurasi',
                'cek_preparing',
                'cek_material',
                'cek_jointing',
                'cek_comtes',
                'cek_ut',
                'cek_rekon',
                'cek_bast',
                'cek_all_delivery',
                'cek_all_delivery_finish',
                'cek_all_installasi',
                'cek_all_installasi_finish',
                'cek_commisioning_tes',
                'cek_ut',
                'cek_rekon',
                'sum_selesai',
                'sum_belum',
                'end_date_plan',
                'end_date_actual'
            )
        );
    }
}
