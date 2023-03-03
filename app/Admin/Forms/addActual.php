<?php

namespace App\Admin\Forms;

use App\Models\LogActual;
use App\Models\MstProject;
use App\Models\TranBaseline;
use Illuminate\Http\Request;
use App\Models\TranSupervisi;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Form;
use App\Models\RefListActivity;
use Encore\Admin\Facades\Admin;

class addActual extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Add Actual';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request)
    {
        //INITIAL VARIABEL
        $actual_status = $request->actual_status;
        $actual_start =  $request->actual_start;
        $actual_finish = null;
        $actual_durasi = null;
        $actual_progress = $request->actual_progress;
        $actual_volume = $request->actual_volume;
        $log_actual_id = $request->log_actual_id;
        $status_const = $request->status_const;
        $status_doc = $request->status_doc;

        $listActivity = TranBaseline::findOrFail($request->tran_baseline_id);
        $actual_volume = $request->actual_volume_old + $request->actual_volume;
        // if ($listActivity->actual_task == 'REJECTED' ) {
        //     $actual_volume = $request->actual_volume;
        // }
        $actual_progress = ($actual_volume / $listActivity->volume) * 100;

        $actual_progress = Round($actual_progress, 1);
        if ($actual_progress >= 100) {
            $actual_progress = 90;
        }
        $progress_bobot =  ($actual_progress / 100) * $request->bobot;
        $progress_bobot =  Round($progress_bobot, 1);
        //STATUS CONSTS BELUM
        if ($actual_status == 'belum') {
            $actual_start = date('Y-m-d');
            $actual_task = 'NEED UPDATED';
        }

        //STATUS CONSTS SELESAI
        if ($actual_status == 'selesai') {
            if ($actual_start == null) {
                $actual_start = date('Y-m-d');
            }
            $actual_finish = date('Y-m-d');
            $actual_task = 'APPROVED';
            $actual_progress = 100;
            $start = strtotime($actual_start);
            $finish = strtotime($actual_finish);

            $jarak = $finish - $start;
            $actual_durasi = $jarak / 60 / 60 / 24;
            $actual_durasi = $actual_durasi + 1;
        }

        $file = $request->file('actual_evident');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        // File extension
        $extension = $file->getClientOriginalExtension();

        // File upload location
        $location = 'uploads/evident';

        // Upload file
        $file->move($location, $filename);

        // File path
        $filepath = 'evident/' . $filename;

       

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

        //CARI STATUS DOC 
        $status_doc = '';
        if ($request->activity_id >= 1 && $request->activity_id <= 21) {
            $status_doc = 'KONSTRUKSI';
        }
        if ($request->activity_id >= 22 && $request->activity_id <= 23) {
            $status_doc = 'ADMINISTRASI';
        }

        if ($request->activity_id >= 1 && $request->activity_id <= 19) {
            //SIMPAN KE LOG ACTUAL
            $logActual = LogActual::create([
                'project_id' => $request->project_id,
                'tran_baseline_id' => $request->tran_baseline_id,
                'actual_volume' => $request->actual_volume,
                'actual_progress' =>  $actual_progress,
                'actual_evident' => $filepath,
                'actual_status' => $actual_status,
                'actual_message' => $request->actual_message,
                'progress_bobot' => $progress_bobot,

                'actual_start' => $actual_start,
                'actual_finish' => $actual_finish,
                'actual_volume' =>  $actual_volume,
                'actual_durasi' => $actual_durasi,
            ]);
            $logActual->save();
            $actual_id = $logActual->id;
            // UPDATE ACTUAL DI TRANSBASELINE    
            TranBaseline::where("id", $request->tran_baseline_id)
                ->update([
                    'actual_status' => $actual_status,
                    'actual_start' => $actual_start,
                    'actual_finish' => $actual_finish,
                    'actual_task' =>  $actual_task,
                    'actual_progress' =>  $actual_progress,
                    'actual_volume' =>  $actual_volume,
                    'actual_durasi' => $actual_durasi,
                   
                ]);
        } else {
            //SIMPAN KE LOG ACTUAL
            $logActual = LogActual::create([
                'project_id' => $request->project_id,
                'tran_baseline_id' => $request->tran_baseline_id,
                'actual_volume' => $request->actual_volume,
                'actual_progress' =>  $actual_progress,
                'actual_evident' => $filepath,
                'actual_status' => $request->actual_status,
                'actual_message' => $request->actual_message,
                'progress_bobot' => $progress_bobot
            ]);
            $logActual->save();
            $actual_id = $logActual->id;

            //UPDATE ACTUAL DI TRANSBASELINE
            TranBaseline::where("id", $request->tran_baseline_id)
                ->update([
                    //'actual_start' => now(),                   
                    //'actual_volume' => $actual_volume,
                    //'actual_progress' =>  $progress_actual,
                    'actual_evident' => $filepath,
                    'actual_status' => $actual_status,
                    'actual_task' =>  'NEED APPROVED',
                    'actual_message' => $request->actual_message,
                    'log_actual_id' => $actual_id,

                ]);
        }





        //update dokumen di supervisi
        $today = date('Y-m-d');
        $plan_finish_const = $request->plan_start;
        $sumPlanBobot = 0;

        if ($plan_finish_const <= $today) {
            $sumPlanBobot = TranBaseline::where("project_id", $request->project_id)->where('activity_id', '<=', $request->activity_id)->sum('bobot');
            TranSupervisi::where("project_id", $request->project_id)
                ->update([
                    'status_const' => $status_const,
                    'status_doc' => $status_doc,
                    'progress_plan' => $sumPlanBobot
                ]);
        } else {
            TranSupervisi::where("project_id", $request->project_id)
                ->update([
                    'status_const' => $status_const,
                    'status_doc' => $status_doc,

                ]);
        }


        admin_success('Processed successfully.');
        //return back();
        return redirect('/ped-panel/actual-generate?id=' . $request->project_id);
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $data = $this->data();

        $this->hidden('project_id');
        $this->hidden('tran_baseline_id');
        $this->hidden('activity_id');
        $this->hidden('bobot');
        $this->text('project_name', 'Lop Site ID')->readonly();
        $this->text('list_activity', 'Activity')->readonly();
        $this->text('volume', 'Volume Kontrak')->readonly();
        $this->text('satuan', 'Satuan')->readonly();
        $this->dateRange('plan_start', 'plan_finish', 'Plan Start and Finish')->readonly();
        $this->text('actual_volume_old', 'Volume Actual Sebelumnya')->readonly();

        $this->divider('Set Actual');

        $this->number('actual_volume', 'Volume Actual')->min(0)->rules('required');
        //$this->image('actual_evident', 'Evident')->rules('required');
        $this->file('actual_evident', 'Evident');
        $this->radio('actual_status')->options(['selesai' => 'Selesai', 'belum' => 'Belum'])->required();
        $this->textarea('actual_message', 'Catatan')->rows(10);
    }

    /**
     * 
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {

        if ($_GET) {
            $id = $_GET['id'];

            $baseline = TranBaseline::findOrFail($id);
            $log_prev = LogActual::where('tran_baseline_id', $baseline->id)->where('approval_waspang', 'approve')->orderBy('id', 'DESC')->first();
            $log_ut = LogActual::where('tran_baseline_id', $baseline->id)->where('approval_tim_ut', 'approve')->orderBy('id', 'DESC')->first();

            if ($baseline->activity_id >= 1 && $baseline->activity_id <= 19) {
                $sumActualVolume =  $baseline->actual_volume;
            }
            if ($baseline->activity_id == 20) {
                $sumActualVolume = LogActual::where("project_id", $baseline->project_id)->where('approval_waspang',  'approve')->where("tran_baseline_id", $baseline->id)->sum('actual_volume');
            }
            if ($baseline->activity_id == 21) {
                $sumActualVolume = LogActual::where("project_id", $baseline->project_id)->where('approval_tim_ut',  'approve')->where("tran_baseline_id", $baseline->id)->sum('actual_volume');
            }

            if ($baseline->supervisi->mitra_id != Admin::user()->id) {
                return abort(404);
            }
            $actual_start = $baseline->actual_start;
            $actual_volume_old = 0;
            if ($baseline->actual_start == NULL) {
                $actual_start = $baseline->plan_start;
            }


            return [
                'project_name' => $baseline->project->lop_site_id,
                'tran_baseline_id' => $baseline->id,
                'project_id' => $baseline->project_id,
                'activity_id' => $baseline->activity_id,
                'list_activity' =>  $baseline->list_activity,

                //'actual_volume' => $baseline->actual_volume,
                'volume' => $baseline->volume,
                'bobot' => $baseline->bobot,
                'satuan' => $baseline->satuan,

                'plan_start' => $baseline->plan_start,
                'plan_finish' => $baseline->plan_finish,

                'actual_start' => $actual_start,
                //'actual_evident' => $baseline->actual_evident,
                //'actual_status' => $baseline->actual_status,
                'actual_progress' => $baseline->actual_progress,
                'actual_message' => $baseline->actual_message,
                'actual_volume_old' => $sumActualVolume,

                'approval_waspang' => $baseline->approval_waspang,
                'approval_tim_ut' => $baseline->approval_tim_ut,
                'approval_message' => $baseline->approval_message,

            ];
        } else {
            return [
                'volume' => '',
            ];
        }
    }
}
