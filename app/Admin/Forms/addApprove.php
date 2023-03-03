<?php

namespace App\Admin\Forms;

use App\Models\LogActual;
use App\Models\TranBaseline;
use App\Models\TranSupervisi;
use Illuminate\Http\Request;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Facades\Admin;

class addApprove extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Approval Activity';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        //GET ID APPROVAL
        $waspangBy = NULL;
        $tim_utBy = NULL;
        $approval_waspang = '';
        $approval_ut = '';

        if ($request->activity_id >= 1 && $request->activity_id <= 20) {
            $approval_waspang = $request->approval;
            $waspangBy = Admin::user()->id;
        }
        if ($request->activity_id == 21) {
            $approval_ut = $request->approval;
            $tim_utBy = Admin::user()->id;
        }

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

            // CARI STATUS CONST
           
            if ($request->activity_id >= 3 && $request->activity_id <= 9) {
                $cek_const = TranBaseline::select('actual_start, actual_finish')
                    ->where('project_id', $request->project_id)
                    ->whereBetween('activity_id', [3, 9])->count();
                $cek_const_actual = TranBaseline::select('actual_start, actual_finish')
                    ->where('project_id', $request->project_id)
                    ->whereNotNull('actual_start')
                    ->whereBetween('activity_id', [3, 9])->count();
                if ($cek_const_actual == $cek_const) {
                    $status_const = "MATERIAL DELIVERY ON SITE";
                }
            }

            if ($request->activity_id >= 10 && $request->activity_id <= 19) {
                $cek_const = TranBaseline::select('actual_start, actual_finish')
                    ->where('project_id', $request->project_id)
                    ->whereBetween('activity_id', [10, 19])->count();
                $cek_const_actual = TranBaseline::select('actual_start, actual_finish')
                    ->where('project_id', $request->project_id)
                    ->whereNotNull('actual_start')
                    ->whereBetween('activity_id', [10, 19])->count();
                if ($cek_const_actual == $cek_const) {
                    $status_const = 'INSTALL DONE';
                }
            }
            if ($request->activity_id == 20) {
                $status_const = 'SELESAI CT';
            }
            if ($request->activity_id == 21) {
                $status_const = 'SELESAI UT';
            }


            //CARI STATUS DOC 
            $status_doc = '';
            if ($request->activity_id >= 1 && $request->activity_id <= 21) {
                $status_doc = 'KONSTRUKSI';
            }
            if ($request->activity_id >= 22 && $request->activity_id <= 23) {
                $status_doc = 'ADMINISTRASI';
            }
        }

        //JIKA DIREJECT
        if ($approval_waspang == 'reject' || $approval_ut == 'reject') {
            $actual_start = null;
            $actual_finish = null;
            $actual_task = 'REJECTED';
            $last_log = LogActual::where('id', $log_actual_id)->first();
            if ($last_log) {
                $actual_volume = $last_log->actual_volume;
                $actual_progress = $last_log->actual_progress;
                $actual_start = $last_log->actual_start;
            } else {
                $actual_volume = null;
                $actual_progress = null;
                $actual_start = null;
            }
        }

        // UPDATE LOG ATUAL
        LogActual::where("id", $log_actual_id)
            ->update([
                'approval_waspang' => $approval_waspang,
                'approval_tim_ut' => $approval_ut,
                'approval_message' =>  $request->approval_message,
                'actual_start' => $actual_start,
                'actual_finish' => $actual_finish,
                'actual_progress' =>  $actual_progress,
                'actual_volume' =>  $actual_volume,
                'actual_durasi' => $actual_durasi,
                'waspang_by' => $waspangBy,
                'tim_ut_by' => $tim_utBy,
            ]);


        // UPDATE ACTUAL DI TRANSBASELINE    
        TranBaseline::where("id", $request->tran_baseline_id)
            ->update([
                'approval_waspang' => $approval_waspang,
                'approval_tim_ut' => $approval_ut,
                'approval_message' =>  $request->approval_message,
                'actual_start' => $actual_start,
                'actual_finish' => $actual_finish,
                'actual_task' =>  $actual_task,
                'actual_progress' =>  $actual_progress,
                'actual_volume' =>  $actual_volume,
                'actual_durasi' => $actual_durasi,
                'waspang_by' => $waspangBy,
                'tim_ut_by' => $tim_utBy,
            ]);

        //update dokumen di supervisi
        $supervisi = TranSupervisi::where('project_id', $request->project_id)->first();
        TranSupervisi::where("project_id", $request->project_id)
            ->update([
                'status_const' => $status_const,
                'status_doc' => $status_doc,
                'progress_actual' => $supervisi->progress_actual + $request->bobot,
            ]);



        admin_success('Processed successfully.');


        return redirect('/ped-panel/actual-generate?id=' . $request->project_id);
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $data = $this->data();
        echo '
        <div class="col-md-12" style="">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Carousel</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered">
                
                <tr>
              ';

        if ($data['log'] != null) {
            foreach ($data['log'] as $d) {

                echo '
                    <td width="50%">
                    <h4>Log Evident</h4>
                      <a href="/uploads/' . $d->actual_evident . '" target="_blank"><img style="max-width:400px;max-height:400px" class="img img-thumbnail" src="/uploads/' . $d->actual_evident . '" alt="evident"> </a>
                        <hr>
                        Volume Actual: ' . $d->actual_volume . ' <br>
                        Progress Actual : ' . $d->actual_progress . ' <br>
                        Status Actual : ' . $d->actual_status . ' <br>
                        Date Report : ' . $d->created_at . ' <br>
                        
                    </td>
                      
                    ';
            }
        }

        echo '
              </tr>
              </table>
              </div>
            ';


        $this->hidden('project_id');
        $this->hidden('actual_start');
        $this->hidden('tran_baseline_id');
        $this->hidden('activity_id');
        $this->hidden('log_actual_id');
        $this->hidden('status_const');

        $this->text('project_name', 'Lop Site ID')->readonly();
        $this->text('list_activity', 'Activity')->readonly();
        $this->text('volume', 'Volume Kontrak')->readonly();
        $this->text('satuan', 'Satuan')->readonly();
        $this->text('bobot', 'bobot')->readonly();
        $this->dateRange('plan_start', 'plan_finish', 'Plan Start and Finish')->readonly();
        //$this->date('actual_start', 'Actual Start')->readonly();       
        $this->text('actual_volume', 'Volume Actual')->readonly();
        $this->text('actual_progress', 'Progress Actual (%)')->icon('fa-pie-chart')->readonly();

        //$this->html('Evident : <img class="img-responsive pad" src="/uploads/' . $data['actual_evident'] . '" alt="Photo">');

        $this->text('actual_status', 'Status Actual')->readonly();

        $this->textarea('actual_message', 'Catatan')->rows(3)->readonly();

        $this->divider('Set Approval');

        $this->select('approval', 'Approval Actual')->options(['approve' => 'approve', 'reject' => 'reject']);
        $this->textarea('approval_message', 'Catatan')->rows(3);
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

            $log = LogActual::where('tran_baseline_id', $id)->get();

            $baseline = TranBaseline::findOrFail($id);
            $supervisi = TranSupervisi::where('project_id', $baseline->project_id)->first();
            if (Admin::user()->inRoles(['waspang'])) {
                if ($baseline->supervisi->waspang_id != Admin::user()->id) {
                    return abort(404);
                }
            }
            if (Admin::user()->inRoles(['tim-ut'])) {
                if ($baseline->supervisi->tim_ut_id != Admin::user()->id) {
                    return abort(404);
                }
            }


            return [
                'log' => $log,
                'project_name' => $baseline->project->lop_site_id,
                'tran_baseline_id' => $baseline->id,
                'project_id' => $baseline->project_id,
                'activity_id' => $baseline->activity_id,
                'list_activity' =>  $baseline->list_activity,

                'actual_volume' => $baseline->actual_volume,
                'volume' => $baseline->volume,
                'bobot' => $baseline->bobot,
                'satuan' => $baseline->satuan,

                'plan_start' => $baseline->plan_start,
                'plan_finish' => $baseline->plan_finish,

                'actual_start' => '',
                'actual_evident' => $baseline->actual_evident,
                'actual_status' => $baseline->actual_status,
                'actual_progress' => $baseline->actual_progress,
                'actual_message' => $baseline->actual_message,

                'approval_waspang' => $baseline->approval,
                'approval_tim_ut' => $baseline->approval_tim_ut,
                'approval_message' => $baseline->approval_message,
                'status_const' => $supervisi->status_const,
                'status_doc' => $supervisi->status_doc,

                'log_actual_id' => $baseline->log_actual_id,

            ];
        } else {
            return [
                'actual_evident' => '',
                'log' => '',
            ];
        }
    }
}
