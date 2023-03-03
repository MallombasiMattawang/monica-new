<?php

namespace App\Admin\Forms;

use App\Models\TranBaseline;
use Illuminate\Http\Request;
use App\Models\TranSupervisi;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Facades\Admin;
use App\Models\TranAdministrasi;

class addBarekon extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Pengiriman BA Rekonsiliasi';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
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

        //update dokumen di supervisi
        $cek = TranSupervisi::where("project_id", $request->project_id)->first();
        $progress_doc = $cek->progress_doc;

        //if ($cek->posisi_doc == 'MITRA REGIONAL') {
        // update actual const di tansbaseline
        TranBaseline::where("id", $request->tran_baseline_id)
            ->update([
               // 'actual_finish' => now(),
                //'actual_volume' => 1,
                // 'actual_progress' =>  100,
                'actual_evident' => $filepath,
                'actual_status' => 'ADMINISTRASI',
                'actual_task' => 'NEED APPROVED',
                'actual_message' => $request->actual_message,

            ]);
        $logAdministrasi = TranAdministrasi::create([
            'project_id' => $request->project_id,
            'status_doc' => 'ADMINISTRASI',
            'posisi_doc' =>  'TELKOM REGIONAL',
            //'progress_doc' => 'SEND TO WITEL',
            'file_doc' => $filepath,
            'status' => 'VERIFIKASI BA',
            'message'  => $request->actual_message,
        ]);
        $logAdministrasi->save();
        TranSupervisi::where("project_id", $request->project_id)
            ->update([
                'status_doc' => 'ADMINISTRASI',
                'posisi_doc' =>  'TELKOM REGIONAL',
                'progress_doc' => 'VERIFIKASI BA',
                'task' => 'ADMINISTRASI',
                'file_ba_rekon' => $filepath,
                'progress_actual' => 90,
            ]);
        //}



        admin_success('Processed successfully.');

        return redirect('/ped-panel/administrasi-generate?id=' . $request->project_id);
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $data = $this->data();

        $this->text('project_id');
        $this->hidden('tran_baseline_id', 'Activity');
        $this->text('project_name', 'Lop Site ID')->readonly();
        $this->text('list_activity', 'Activity')->readonly();
        $this->text('volume', 'Volume Kontrak')->readonly();
        $this->text('satuan', 'Satuan')->readonly();
        $this->dateRange('plan_start', 'plan_finish', 'Plan Start and Finish')->readonly();

        $this->divider('Administrasi');


        $this->file('actual_evident', 'Evident BA Rekonsiliasi')->rules('mimes:jpg,png,pdf|required');

        $this->textarea('actual_message', 'Catatan')->rows(10);
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
            if ($baseline->supervisi->mitra_id != Admin::user()->id) {
                return abort(404);
            }
            $actual_start = $baseline->actual_start;
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
                'actual_status' => $baseline->actual_status,
                'actual_progress' => $baseline->actual_progress,
                'actual_message' => $baseline->actual_message,
                'actual_volume_old' => $baseline->actual_volume,

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
