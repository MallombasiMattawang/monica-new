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

class PlanController extends Controller
{
    public function planActivity($id, $slug)
    {
        $user_id =  getUser()->id;
        if (activeGuard() == 'waspang') {
            $user = "waspang_id = $user_id ";
        } else if (activeGuard() == 'tim_ut') {
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
        $countBase = TranBaseline::where("project_id", $supervisi->project_id)->where('bobot', '>=', '1')->count();
        $sumBase = TranBaseline::where("project_id", $supervisi->project_id)->where('bobot', '>=', '1')->sum('bobot');
        $countPlan = TranBaseline::where("project_id", $supervisi->project_id)->where('plan_durasi', '>=', '1')->count();

        $plan_start = TranBaseline::select(['id', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 1)
            ->first();
        $plan_finish = TranBaseline::select(['id', 'plan_finish'])
            ->where('project_id', $supervisi->project_id)
            ->orderBy('plan_finish', 'DESC')
            ->first();
        $plan_durasi = selisih_hari($plan_start->plan_start, $plan_finish->plan_finish);


        $sumDurasi = TranBaseline::where("project_id", $supervisi->project_id)->where('plan_durasi', '>=', '1')->sum('plan_durasi');
        $cek_preparing = TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 2)
            ->first();
        $cek_material = TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('category_id', ' 002 ')
            ->orderBy('activity_id', 'desc')
            ->first();

        $cek_jointing = TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 19)
            ->first();
        $cek_comtes = TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 20)
            ->first();
        $cek_ut = TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 21)
            ->first();
        $cek_rekon = TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 22)
            ->first();
        $cek_bast = TranBaseline::select(['id', 'plan_finish', 'plan_start'])
            ->where('project_id', $supervisi->project_id)
            ->where('activity_id', 23)
            ->first();
        $minActivityDelivery = TranBaseline::where('category_id', ' 002 ')
            ->where('project_id', $supervisi->project_id)
            ->min('activity_id');

        $maxActivityDelivery = TranBaseline::where('category_id', ' 002 ')
            ->where('project_id', $supervisi->project_id)
            ->max('activity_id');

        $cek_all_delivery = TranBaseline::select('plan_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereBetween('activity_id', [$minActivityDelivery, $maxActivityDelivery])
            ->count();

        $cek_all_delivery_finish = TranBaseline::select('plan_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereNotNull('plan_finish')
            ->whereBetween('activity_id', [$minActivityDelivery, $maxActivityDelivery])
            ->count();

        $minActivityInstalasi = TranBaseline::where('category_id', ' 003 ')
            ->where('project_id', $supervisi->project_id)
            ->min('activity_id');

        $maxActivityInstalasi = TranBaseline::where('category_id', ' 003 ')
            ->where('project_id', $supervisi->project_id)
            ->max('activity_id');

        $cek_all_installasi = TranBaseline::select('plan_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereBetween('activity_id', [$minActivityInstalasi, 19])->count();

        $cek_all_installasi_finish = TranBaseline::select('plan_finish')
            ->where('project_id', $supervisi->project_id)
            ->whereNotNull('plan_finish')
            ->whereBetween('activity_id', [$minActivityInstalasi, 19])->count();

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
                'plan_durasi',
                'minActivityDelivery',
                'maxActivityDelivery',
                'minActivityInstalasi',
                'maxActivityInstalasi',
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

        return back();
    }
}
