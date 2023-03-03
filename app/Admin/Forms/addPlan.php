<?php

namespace App\Admin\Forms;

use App\Models\MstProject;
use Encore\Admin\Widgets\Form;
use App\Models\TranBaseline;
use Illuminate\Http\Request;
use Encore\Admin\Facades\Admin;

class addPlan extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Update Plan Activity';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $plan_start = strtotime($request->plan_start);
        $plan_finish = strtotime($request->plan_finish);

        $jarak = $plan_finish - $plan_start;

        $plan_durasi = $jarak / 60 / 60 / 24;


        $plan_durasi = $plan_durasi + 1;




        TranBaseline::where("id", $request->activity_id)
            ->update([
                'plan_start' => $request->plan_start,
                'plan_finish' => $request->plan_finish,
                'plan_durasi' => $plan_durasi
            ]);


        admin_success('Processed successfully.');
        return redirect('/ped-panel/plan-generate?id=' . $request->project_id);
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $data = $this->data();

        $this->hidden('project_id');
        $this->hidden('activity_id', 'Activity');

        $this->text('project_name', 'Lop Site ID')->readonly();
        $this->text('list_activity', 'Activity')->readonly();
        $this->text('volume', 'Volume Kontrak')->readonly();
        $this->text('bobot', 'bobot')->readonly();
        $this->text('satuan', 'Satuan')->readonly();

        $this->divider('Set Date Plan');
        $this->dateRange('plan_start', 'plan_finish', 'Plan Start and Finish')->rules('required');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        if ($_GET) {
            $id = $_GET['id'];

            
            $baseline = TranBaseline::findOrFail($id);
            $project = MstProject::where('id', $baseline->project_id)->first();
            if ($baseline->supervisi->mitra_id != Admin::user()->id) {
                return abort(404);
            }
           
            
            $plan_start = $baseline->plan_start;
            $plan_finish = $baseline->plan_finish;

            if ($baseline->activity_id == 1) {
                $plan_start = date('Y-m-d', strtotime($project->start_date));
            }    
            
            if ($baseline->plan_start == NULL && $id !=1) {
                $baseline_old = TranBaseline::findOrFail($id - 1);
                $plan_start = $baseline_old->plan_finish;
                if ($baseline->activity_id != 1) {
                    $plan_finish = date('Y-m-d', strtotime('+1 days', strtotime($plan_start)));
                }
                          
            }
            return [
                'project_name' => $baseline->project->lop_site_id,

                'project_id' => $baseline->project_id,
                'activity_id' => $baseline->id,
                'list_activity' =>  $baseline->list_activity,

                'volume' => $baseline->volume,
                'bobot' => $baseline->bobot,
                'satuan' => $baseline->satuan,

                'plan_start' => $plan_start,
                'plan_finish' => $plan_finish,

            ];
        } else {
            return [];
        }
    }
}
