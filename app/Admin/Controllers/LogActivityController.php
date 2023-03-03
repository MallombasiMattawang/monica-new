<?php

namespace App\Admin\Controllers;

use App\Models\MstProject;
use App\Models\TranBaseline;
use Encore\Admin\Widgets\Tab;
use App\Admin\Forms\AccProject;
use App\Admin\Forms\addActual;
use App\Models\RefListActivity;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;

use Encore\Admin\Controllers\AdminController;

class LogActivityController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Log Actual controller';

    public function actualActivity(Content $content)
    {
        return Admin::content(function (Content $content) {

            $id = $_GET['id'];
            $project = MstProject::where("id", $id)->first();
            $checkBaseline = TranBaseline::where("project_id", $id)->exists();
            $content->header('Basline Activity Project');
            $content->description('Desc...');

            if ($checkBaseline) {
                $lists = TranBaseline::where("project_id", $id)->get();
                $countBase = TranBaseline::where("project_id", $id)->where('bobot', '>', '1')->count();
                $sumBase = TranBaseline::where("project_id", $id)->where('bobot', '>', '1')->sum('bobot');
                $countPlan = TranBaseline::where("project_id", $id)->where('plan_durasi', '>', '1')->count();
                $sumDurasi = TranBaseline::where("project_id", $id)->where('plan_durasi', '>', '1')->sum('plan_durasi');
                $content->body(view('admin.modul_baseline.actual', [
                    'project' => $project,
                    'countBase' => $countBase,
                    'sumBase' => $sumBase,
                    'countPlan' => $countPlan,
                    'sumDurasi' =>  $sumDurasi,
                    'lists' => $lists,
                    'id' => $id,
                ]));
            } else {
                $lists = RefListActivity::all();
                $deliveryKabel = $project->panjang_feeder + $project->panjang_dist;
                $deliveryTiang = $project->tiang_baru;
                $deliveryOdp =  $project->odp_odp_8 + $project->odp_odp_16;
                $deliveryOdc =  $project->odc_total;
                $penarikanFeeder = $project->panjang_feeder;
                $penarikanDist = $project->panjang_dist;
                $countBase = 0;
                $countPlan = 0;
                $sumDurasi = 0;
                $content->body(view('admin.modul_baseline.generate', [
                    'project' => $project,
                    'deliveryKabel' => $deliveryKabel,
                    'deliveryTiang' => $deliveryTiang,
                    'deliveryOdp' => $deliveryOdp,
                    'deliveryOdc' => $deliveryOdc,
                    'penarikanFeeder' => $penarikanFeeder,
                    'penarikanDist' => $penarikanDist,
                    'countBase' => $countBase,
                    'countPlan' => $countPlan,
                    'sumDurasi' =>  $sumDurasi,
                    'lists' => $lists,
                    'id' => $id,
                ]));
            }
        });
    }

    public function addActual(Content $content)
    {
        return $content
            ->title('Add Actual')
            ->body(new addActual());
    }

    


}
