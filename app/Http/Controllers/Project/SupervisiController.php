<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\LogPlan;
use App\Models\MstProject;
use App\Models\TranBaseline;
use App\Models\TranSupervisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupervisiController extends Controller
{
    public function index(Request $request)
    {

        middlewareCheck(['web', 'mitra', 'waspang', 'tim-ut']);

        $insight = true;

        $insightsupervisi = "";

        $pageTitle = 'Supervisi ' . activeGuard() . '';
        $breadcrumb = [
            'Data Project',
            'Supervisi',
        ];

        $where = '';

        $keyword = request()->input('keyword');
        if (!empty($keyword)) {
            $where .= "AND project_name LIKE '%$keyword%' ";
        }

        $skip = $request->input('skip');
        $take = "20";

        $user_id = getUser()->id;
        if (activeGuard() == 'waspang') {
            $user = "waspang_id = $user_id ";
        } else if (activeGuard() == 'tim-ut') {
            $user = "tim_ut_id = $user_id ";
        } else {
            $user = "mitra_id = $user_id ";
        }

        $results = TranSupervisi::whereRaw("$user $where")
            ->skip($skip)
            ->take($take)
            ->orderBy('id', 'DESC')
            ->get();

        // return $results;

        $response = '';
        if ($request->ajax()) {

            $id = 1 + $skip;

            foreach ($results as $supervisi) {

                $status_const = ($supervisi->status_const) ? "$supervisi->status_const" : "BELUM ADA";
                $today = date('Y-m-d');
                $progress_plan = TranBaseline::where("project_id", $supervisi->project_id)->whereBetween('plan_finish', [$supervisi->supervisi_project->start_date, $today])->sum('bobot');
                $bg = '';
                $blink = '';
                if ($supervisi->task == 'NEED APPROVED WASPANG' && activeGuard() == 'waspang') {
                    $bg = 'bg-light-success';
                    $blink = 'blink';
                } elseif ($supervisi->task == 'NEED APPROVED TIM UT' && activeGuard() == 'tim-ut') {
                    $bg = 'bg-light-success';
                    $blink = 'blink';
                }
                $ssStatus = 'bg-success';
                if ($supervisi->supervisi_project->status_project == 'DROP') {
                    $ssStatus = 'bg-danger';
                }
                $response .= '
                 <div class="col-md-4 hello" id="' . $id++ . '">
                 <div class="card ' . $bg . '">
                 <div class="card-body">
                   <h6 class="mb-1"><a href="' . route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)]) . '" class="color-600">' . $supervisi->project_name . '</a></h6>
                   <p class="text-muted">WITEL : ' . $supervisi->supervisi_witel->name . '</p>

                   <div class="project-members mb-4">
                   <label class="me-2">Status :</label>
                     <span class="badge ' . $ssStatus . '">' . $supervisi->supervisi_project->status_project . ' </span>
                     <label class="me-2">Const :</label>
                     <span class="badge bg-warning ' . $blink . '">' . $status_const . ' </span>

                   </div>
                   <label class="small d-flex justify-content-between">Progress Plan ' . getProgressPlan($supervisi->project_id, $supervisi->supervisi_project->start_date) . '% <span class="text-custom">100%</span></label>
                   <div class="progress mt-1" style="height: 3px;">
                     <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: ' . $progress_plan . '%;"></div>
                   </div>
                   <br>
                   <label class="small d-flex justify-content-between">Progress Actual ' . getProgressActual($supervisi->project_id, $supervisi->supervisi_project->start_date) . '% <span class="text-custom">100%</span></label>
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
        $data = MstProject::where('id', $profil->project_id)->first();
        $count = DB::table('tran_baseline')
            ->select(
                DB::raw('COUNT(CASE WHEN project_id = ' . $profil->project_id . ' AND activity_id BETWEEN 1 AND 2 THEN id END) AS prepare'),
                DB::raw('COUNT(CASE WHEN project_id = ' . $profil->project_id . ' AND activity_id BETWEEN 1 AND 2 AND actual_finish IS NOT NULL THEN id END) AS real_prepare'),
                DB::raw('COUNT(CASE WHEN project_id = ' . $profil->project_id . ' AND activity_id BETWEEN 3 AND 9 THEN id END) AS delivery'),
                DB::raw('COUNT(CASE WHEN project_id = ' . $profil->project_id . ' AND activity_id BETWEEN 3 AND 9 AND actual_finish IS NOT NULL THEN id END) AS real_delivery'),
                DB::raw('COUNT(CASE WHEN project_id = ' . $profil->project_id . ' AND activity_id BETWEEN 10 AND 20 THEN id END) AS instalasi'),
                DB::raw('COUNT(CASE WHEN project_id = ' . $profil->project_id . ' AND activity_id BETWEEN 10 AND 20 AND actual_finish IS NOT NULL THEN id END) AS real_instalasi'),
                DB::raw('COUNT(CASE WHEN project_id = ' . $profil->project_id . ' AND activity_id BETWEEN 21 AND 23 THEN id END) AS closing'),
                DB::raw('COUNT(CASE WHEN project_id = ' . $profil->project_id . ' AND activity_id BETWEEN 21 AND 23 AND actual_finish IS NOT NULL THEN id END) AS closing_real')
            )
            ->first();

        $stat_prepare = ($count->prepare != 0) ? (($count->real_prepare / $count->prepare) * 100) : 0;
        $stat_delivery = ($count->delivery != 0) ? (($count->real_delivery / $count->delivery) * 100) : 0;
        $stat_instalasi = ($count->instalasi != 0) ? (($count->real_instalasi / $count->instalasi) * 100) : 0;
        $closing = ($count->closing != 0) ? (($count->closing_real / $count->closing) * 100) : 0;

        $pageTitle = $profil->project_name;
        $breadcrumb = [
            'Supervisi',
            'Detail',
        ];
        return view(
            'pengguna.pages.supervisi.detail',
            compact(
                'pageTitle',
                'profil',
                'data',
                'stat_prepare',
                'stat_delivery',
                'stat_instalasi',
                'closing',
                'breadcrumb'
            )
        );
    }

    public function kurvaS($id)
    {
        $project = MstProject::where("id", $id)->first();
        $supervisi = TranSupervisi::where('project_id', $id)->first();
        // $lists = TranBaseline::where("project_id", $id)
        //     ->select('id', 'activity_id', 'bobot', 'plan_durasi', 'plan_start', 'plan_finish')
        //     ->get();
        $lists_asc_date = TranBaseline::where("project_id", $id)->orderBy('plan_finish', 'ASC')->get();
        $end_date_plan = TranBaseline::where("project_id", $id)->whereNotNull('plan_finish')->orderBy('plan_finish', 'Desc')->first();
        $end_date_actual = TranBaseline::where("project_id", $id)->whereNotNull('actual_finish')->orderBy('id', 'Desc')->first();

        $start = $project->start_date;
        $end_plan = $end_date_plan->plan_finish;
        $end_finish = 0;
        if ($end_date_actual) {
            $end_finish = $end_date_actual->actual_finish;
        }

        $end_today = date('Y-m-d'); //end dihari ini
        $end = $end_plan;
        if ($end_finish > $end_plan) {
            $end = $end_finish;
        }
        if ($supervisi->progress_actual < 100) {
            // $end = $end_today;
            $end = $end;
        }
        $sum_bobot_plan = LogPlan::where('project_id', $project->id)
            ->whereBetween('log_date', [$project->start_date, $start])
            ->sum('log_bobot');
        $sum_bobot_real = TranBaseline::where('project_id', $project->id)
            ->whereBetween('actual_start', [$project->start_date, $start])
            ->sum('bobot');

        $items = array();
        $i = 1;
        while (strtotime($start) <= strtotime($end)) {
            $items[] = ([
                'date' => tgl_indo($start),
                'bobot_plan' => number_format($sum_bobot_plan, 1, '.', ''),
                'bobot_real' => $sum_bobot_real,
            ]);
            $start = date('Y-m-d', strtotime('+1 day', strtotime($start))); //looping tambah 1 date
            $sum_bobot_plan = LogPlan::where('project_id', $project->id)
                ->whereBetween('log_date', [$project->start_date, $start])
                ->sum('log_bobot');

            // $sum_bobot_real = TranBaseline::where('project_id', $project->id)
            //   ->whereBetween('actual_start', [$project->start_date, $start])
            //   ->sum('bobot');

            $sum_bobot_real = TranBaseline::where('project_id', $project->id)
                ->whereNotIn('activity_id', [20, 21])
                ->whereBetween('actual_start', [$project->start_date, $start])
            //->selectRaw('SUM(bobot * (actual_progress/100 )) as total')
                ->selectRaw('ROUND(SUM(bobot * (actual_progress/100 )), 1) as total')
                ->value('total');

            $sum_bobot_ct_ut = TranBaseline::where('project_id', $project->id)
                ->whereIn('activity_id', [20, 21])
                ->whereBetween('actual_finish', [$project->start_date, $start])
                ->selectRaw('ROUND(SUM(bobot * (actual_progress/100 )), 1) as total')
                ->value('total');

            if ($end_today < $start) {
                $sum_bobot_real = null;
            } else {
                $sum_bobot_real = ($sum_bobot_real != null || $sum_bobot_ct_ut != null) ? $sum_bobot_real + $sum_bobot_ct_ut : 0;
            }
        }

        //make response JSON
        return response()->json([
            'status' => 'success',
            'data' => $items,
            //'date' => $person,
        ], 200);
    }
}
