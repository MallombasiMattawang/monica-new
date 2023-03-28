<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\MstWitel;
//use Encore\Admin\Admin;
use App\Models\LogActual;
use App\Models\MstProject;
use App\Admin\Forms\addPlan;
use App\Models\MstWaspangUt;
use App\Models\TranBaseline;
use Encore\Admin\Layout\Row;

//use Illuminate\Http\Request;
use App\Models\TranSupervisi;
use Encore\Admin\Widgets\Box;
use App\Admin\Forms\addActual;
use App\Admin\Forms\addApprove;
use App\Models\RefListActivity;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\DB;
use App\Admin\Actions\Project\Plan;
use App\Admin\Forms\addAdministrasi;
use App\Admin\Actions\Project\Actual;
use App\Admin\Actions\Project\Baseline;
use App\Admin\Actions\Project\ActualActivity;
use App\Admin\Actions\Project\Administrasi;
use App\Admin\Forms\addApproveAdministrasi;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;
use App\Admin\Extensions\Tools\GridView;
use App\Admin\Forms\addBarekon;
use App\Admin\Forms\addBast;
use App\Models\TranAdministrasi;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Encore\Admin\Widgets;



class TranAdministrasiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TABLE ADMINISTRASI';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TranSupervisi);
        if (Admin::user()->inRoles(['witel'])) {
            //$grid->model()->where('witel_id', '=', Admin::user()->id);
        }
        $grid->model()->whereIn('status_doc', ['ADMINISTRASI', 'FINISH']);
        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();

            $filter->column(1 / 2, function ($filter) {
                $filter->like('project_name', 'LOP / SITE ID');
                $filter->like('supervisi_project.witel_id', 'WITEL');
                $filter->like('supervisi_project.mitra_id', 'MITRA');
            });

            $filter->column(1 / 2, function ($filter) {
                $filter->in('posisi_doc', 'POSISI DOC')->multipleSelect(['MITRA AREA' => 'MITRA AREA', 'WITEL' => 'WITEL', 'MITRA REGIONAL' => 'MITRA REGIONAL', 'TELKOM REGIONAL' => 'TELKOM REGIONAL']);
                $filter->in('status_doc', 'STATUS DOC')->multipleSelect(['ADMINISTRASI' => 'ADMINISTRASI', 'FINISH' => 'FINISH']);
                $filter->in('progress_doc', 'PROGRESS DOC')->multipleSelect(['PEMBUATAN DOC' => 'PEMBUATAN DOC', 'VERIFIKASI DOC' => 'VERIFIKASI DOC', 'REVISI DOC' => 'REVISI DOC', 'PENGIRIMAN DOC KE REGIONAL' => 'PENGIRIMAN DOC KE REGIONAL', 'REVISI DOC REGIONAL' => 'REVISI DOC REGIONAL', 'PROSES TANDA TANGAN' => 'PROSES TANDA TANGAN', 'DOK OK' => 'DOK OK']);
            });
        });

        $grid->column('supervisi_project.tematik', __('Tematik'));
        $grid->column('supervisi_project.witel_id', __('Witel'));
        $grid->column('supervisi_project.sto_id', __('STO'));
        $grid->column('project_name', __('Project name'))->limit(30);
        $grid->column('supervisi_project.mitra_id', __('Mitra'))->limit(20);
        $grid->column('supervisi_sap.kontrak', __('NO. SP TELKOM'));

        $grid->column('progress_doc', __('Progress Doc'))->limit(30);
        $grid->column('progress_actual')->display(function ($progress_actual) {
            return "<span style='color:blue'>$progress_actual %</span>";
        });
        $grid->column('progress_plan')->display(function ($progress_plan) {
            return "<span style='color:blue'>$progress_plan %</span>";
        });
        $grid->tools(function ($tools) {
            // $tools->append(new GridView());
        });
        // if (Request::get('view') !== 'table') {
        $grid->setView('admin.grid.card_administrasi');
        //}
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->disableActions();
        //$grid->fixColumns(4, -1);
        Admin::style('.table {
            #background: #ee99a0;
            border-radius: 0.2rem;
            width: 100%;
            padding-bottom: 1rem;
            color: #212529;
            margin-bottom: 0;
          }     
            .table th {
            text-transform: uppercase;
            white-space: nowrap;
            background-color: #ffffd5;
          }');
        return $grid;
    }

    protected function detail($id)
    {
        $data = MstProject::findOrFail($id);
        return view('admin.modul_administrasi.detail', [
            'data' => $data
        ]);
    }

    // public function administrasiGenerate()
    // {
    //     return Admin::content(function (Content $content) {
    //         // optional
    //         $content->header('Administrasi');

    //         // optional
    //         $content->description('Kelola administrasi Rekonsiliasi');

    //         // add breadcrumb since v1.5.7
    //         $content->breadcrumb(
    //             ['text' => 'Dashboard', 'url' => '/admin'],
    //             ['text' => 'User management', 'url' => '/admin/users'],
    //             ['text' => 'Edit user']
    //         );
    //         $id = $_GET['id'];
    //         $supervisi = TranSupervisi::where('project_id', $id)->first();
    //         $baseline = TranBaseline::where('project_id', $id)->where('activity_id', 22)->first();
    //         // Direct rendering view, Since v1.6.12
    //         $content->view('admin.modul_administrasi.index', [
    //             'baseline' => $baseline,
    //             'supervisi' => $supervisi,
    //         ]);
    //     });
    // }

    public function administrasiGenerate(Content $content)
    {
        $id = $_GET['id'];
        $project = TranSupervisi::where("project_id", $id)->first();
        $mitra_area = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'MITRA AREA')->where('status', '!=', 'PENGIRIMAN DOC KE REGIONAL')->orderBy('id', 'DESC')->first();
        $mitra_area_2 = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'MITRA AREA')->where('status', 'PENGIRIMAN DOC KE REGIONAL')->orderBy('id', 'DESC')->first();

        $pembuatan_dokumen = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'MITRA AREA')->where('status', 'PEMBUATAN DOC')->orderBy('id', 'DESC')->first();
        $send_to_witel = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'MITRA AREA')->where('status', 'SEND TO WITEL')->orderBy('id', 'DESC')->first();
        $witel_verifikasi = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'WITEL')->where('status', 'VERIFIKASI DOC')->orderBy('id', 'DESC')->first();
        $witel_reject = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'WITEL')->where('status', 'REJECTED')->orderBy('id', 'DESC')->first();
        $witel_approve = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'WITEL')->where('status', 'PROSES TANDA TANGAN')->orderBy('id', 'DESC')->first();
        $witel_ttd = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'WITEL')->where('status', 'DOC DITANDA TANGANI')->orderBy('id', 'DESC')->first();

        $send_to_regional = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'MITRA AREA')->where('status', 'SEND TO REGIONAL')->orderBy('id', 'DESC')->first();
        $regional_verifikasi = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'MITRA REGIONAL')->where('status', 'VERIFIKASI INTERNAL')->orderBy('id', 'DESC')->first();
        $regional_approve = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'MITRA REGIONAL')->where('status', 'DOC VERIFIED')->orderBy('id', 'DESC')->first();
        $regional_reject = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'MITRA REGIONAL')->where('status', 'REJECTED')->orderBy('id', 'DESC')->first();

        $telkom_verifikasi = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'TELKOM REGIONAL')->where('status', 'VERIFIKASI DOC')->orderBy('id', 'DESC')->first();
        $telkom_reject = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'TELKOM REGIONAL')->where('status', 'REJECTED')->orderBy('id', 'DESC')->first();
        $telkom_approve = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'TELKOM REGIONAL')->where('status', 'PROSES TANDA TANGAN')->orderBy('id', 'DESC')->first();
        $telkom_ttd = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'TELKOM REGIONAL')->where('status', 'DOC DITANDA TANGANI')->orderBy('id', 'DESC')->first();
        $telkom_verifikasi_ba = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'TELKOM REGIONAL')->where('status', 'VERIFIKASI BA')->orderBy('id', 'DESC')->first();
        $telkom_approve_ba = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'TELKOM REGIONAL')->where('status', 'BA VERIFIED')->orderBy('id', 'DESC')->first();
        $telkom_reject_ba = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'TELKOM REGIONAL')->where('status', 'REJECTED BA')->orderBy('id', 'DESC')->first();


        $witel = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'WITEL')->orderBy('id', 'DESC')->first();
        $mitra_regional = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'MITRA REGIONAL')->orderBy('id', 'DESC')->first();
        $telkom_regional = TranAdministrasi::where('project_id', $id)->where('posisi_doc', 'TELKOM REGIONAL')->orderBy('id', 'DESC')->first();
        $supervisi = TranSupervisi::where('project_id', $id)->first();
        $baseline = TranBaseline::where('project_id', $id)->where('activity_id', 22)->first();


        $content->title('Administrasi');
        $content->description('Kelola administrasi Rekonsiliasi');
        $content->view('admin.modul_administrasi.mitra', [
            'project' => $project,
            'mitra_area' => $mitra_area,
            'pembuatan_dokumen' => $pembuatan_dokumen,
            'send_to_witel' => $send_to_witel,
            'witel_verifikasi' => $witel_verifikasi,
            'witel_reject' => $witel_reject,
            'witel_approve' => $witel_approve,
            'witel_ttd' => $witel_ttd,
            'witel' => $witel,
            'mitra_regional' => $mitra_regional,
            'telkom_regional' => $telkom_regional,
            'send_to_regional' => $send_to_regional,
            'regional_verifikasi' => $regional_verifikasi,
            'regional_approve' => $regional_approve,
            'regional_reject' => $regional_reject,

            'telkom_verifikasi' => $telkom_verifikasi,
            'telkom_reject' => $telkom_reject,
            'telkom_approve' => $telkom_approve,
            'telkom_ttd' => $telkom_ttd,
            'telkom_verifikasi_ba' => $telkom_verifikasi_ba,
            'telkom_approve_ba' => $telkom_approve_ba,
            'telkom_reject_ba' => $telkom_reject_ba,

            'baseline' => $baseline,
            'supervisi' => $supervisi,
        ]);

        return $content;
        //     ->title('Tabbed form')
        //     ->body(Widgets\Tab::forms([
        //         'basic'    => addAdministrasi::class,

        //     ]));
    }


    public function addDocument(Content $content)
    {
        return $content
            ->title('Lembar Administrasi')
            ->row(function (Row $row) {
                $id = $_GET['id'];
                $supervisi = TranSupervisi::where('project_id', $id)->first();
                $baseline = TranBaseline::where('activity_id', 22)->first();

                $data = view('admin.modul_administrasi.index', [
                    'baseline' => $baseline,
                    'supervisi' => $supervisi,
                ]);
                $row->column(12, new Box('Administrasi Rekonsiliasi', $data));
            });
    }

    public function SaveApproveAdministrasi(Request $request)
    {
        print_r($_POST);
        //die();
        $supervisi = TranSupervisi::where('project_id', $request->id)->first();
        $baseline = TranBaseline::where('project_id', $supervisi->project_id)->where('activity_id', 22)->first();
        if (Admin::user()->inRoles(['witel'])) {
            if ($request->approval == 'approve') {
                if ($supervisi->progress_doc == 'PROSES TANDA TANGAN') {
                    TranSupervisi::where("project_id", $request->id)
                        ->update([
                            'posisi_doc' => 'MITRA AREA',
                            'progress_doc' => 'PENGIRIMAN DOC KE REGIONAL',
                            'progress_actual' => 98,
                            'status_const' => 'REKON',
                        ]);
                    // $start = strtotime($baseline->actual_start);
                    // $finish = strtotime(date('Y-m-d'));

                    // $jarak = $finish - $start;
                    // $actual_durasi = $jarak / 60 / 60 / 24;
                    // $actual_durasi = $actual_durasi + 1;
                    // TranBaseline::where("id", $baseline->id)
                    //     ->update([
                    //         //'actual_start' => date('Y-m-d'),
                    //        // 'actual_finish' => date('Y-m-d'),
                    //         //'actual_durasi' => $actual_durasi,
                    //         //'actual_volume' => 1,
                    //         //'actual_progress' => 100,
                    //         //'actual_task' =>  'APPROVED',
                    //         'approval_message' =>  $request->approval_message,
                    //         'actual_task' =>  'APPROVED',
                    //     ]);
                    $logAdministrasi = TranAdministrasi::create([
                        'project_id' => $request->id,
                        'status_doc' => 'ADMINISTRASI',
                        'posisi_doc' => 'WITEL',
                        //'progress_doc' => 'PROSES TANDA TANGAN',
                        'status' => 'DOC DITANDA TANGANI',
                        'message'  => $request->approval_message,
                    ]);
                    $logAdministrasi->save();
                    $logAdministrasi = TranAdministrasi::create([
                        'project_id' => $request->id,
                        'status_doc' => 'ADMINISTRASI',
                        'posisi_doc' => 'MITRA AREA',
                        //'progress_doc' => 'PROSES TANDA TANGAN',
                        'status' => 'PENGIRIMAN DOC KE REGIONAL',
                        'message'  => $request->approval_message,
                    ]);
                    $logAdministrasi->save();
                } else {
                    TranSupervisi::where("project_id", $request->id)
                        ->update([
                            'posisi_doc' => 'WITEL',
                            'progress_doc' => 'PROSES TANDA TANGAN',
                            'progress_actual' => 96,
                            'status_const' => 'REKON',
                        ]);
                   
                    $logAdministrasi = TranAdministrasi::create([
                        'project_id' => $request->id,
                        'status_doc' => 'ADMINISTRASI',
                        'posisi_doc' => 'WITEL',
                        //'progress_doc' => 'PROSES TANDA TANGAN',
                        'status' => 'DOC VERIFIED',
                        'file_doc' => $supervisi->file_doc_witel,
                        'message'  => $request->approval_message,
                    ]);
                    $logAdministrasi->save();
                    $logAdministrasi = TranAdministrasi::create([
                        'project_id' => $request->id,
                        'status_doc' => 'ADMINISTRASI',
                        'posisi_doc' => 'WITEL',
                        //'progress_doc' => 'PROSES TANDA TANGAN',
                        'status' => 'PROSES TANDA TANGAN',
                        'file_doc' => $supervisi->file_doc_witel,
                        'message'  => $request->approval_message,
                    ]);
                    $logAdministrasi->save();
                }
            }
            if ($request->approval == 'reject') {
                TranSupervisi::where("project_id", $request->id)
                    ->update([
                        'posisi_doc' => 'MITRA AREA',
                        'progress_doc' => 'REVISI DOC',
                        'status_const' => 'REKON',
                    ]);
                // UPDATE TRANBASELINE
                TranBaseline::where("id", $baseline->id)
                    ->update([
                        //'actual_start' => date('Y-m-d'),
                        'actual_task' =>  'REJECTED',
                        'approval_message' =>  $request->approval_message,
                    ]);
                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'MITRA AREA',
                    //'progress_doc' => 'PROSES TANDA TANGAN',
                    'status' => 'REVISI DOC',
                    'message'  => $request->approval_message,
                ]);
                $logAdministrasi->save();
                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'WITEL',
                    //'progress_doc' => 'PROSES TANDA TANGAN',
                    'status' => 'REJECTED',
                    'message'  => $request->approval_message,
                ]);
                $logAdministrasi->save();
            }
        }

        if (Admin::user()->inRoles(['mitra'])) {
            if ($request->approval == 'approve') {
                TranSupervisi::where("project_id", $request->id)
                    ->update([
                        'posisi_doc' => 'TELKOM REGIONAL',
                        'progress_doc' => 'VERIFIKASI DOC',
                        'progress_actual' => 90,
                        'status_const' => 'REKON',
                    ]);


                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'MITRA REGIONAL',
                    'status' => 'DOC VERIFIED',
                    'message'  => $request->approval_message,
                    'file_doc' => $supervisi->file_doc_ped,

                ]);
                $logAdministrasi->save();
                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'TELKOM REGIONAL',
                    'status' => 'VERIFIKASI DOC',
                    'message'  => $request->approval_message,
                    'file_doc' => $supervisi->file_doc_ped,

                ]);
                $logAdministrasi->save();
            }
            if ($request->approval == 'reject') {
                TranSupervisi::where("project_id", $request->id)
                    ->update([
                        'posisi_doc' => 'MITRA AREA',
                        'progress_doc' => 'REVISI DOC REGIONAL',
                        'status_const' => 'REKON',
                    ]);

                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'MITRA AREA',
                    'status' => 'REVISI DOC REGIONAL',
                    'message'  => $request->approval_message,
                ]);
                $logAdministrasi->save();
                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'MITRA REGIONAL',
                    'status' => 'REJECTED',
                    'message'  => $request->approval_message,
                ]);
                $logAdministrasi->save();
            }
        }

        if (Admin::user()->inRoles(['administrator', 'hd-ped'])) {
            $baseline = TranBaseline::where('project_id', $supervisi->project_id)->where('activity_id', 23)->first();
            if ($request->approval == 'approve') {

                TranSupervisi::where("project_id", $request->id)
                    ->update([
                        'posisi_doc' => 'TELKOM REGIONAL',
                        'progress_doc' => 'PROSES TANDA TANGAN',
                        'status_const' => 'REKON',
                    ]);

                TranBaseline::where("id", $baseline->id)
                    ->update([

                        'actual_start' => date('Y-m-d'),
                        'actual_volume' => 1,
                        'actual_progress' => 90,
                        //'actual_durasi' =>  $actual_durasi,

                    ]);
                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'TELKOM REGIONAL',
                    'status' => 'PROSES TANDA TANGAN',
                    'message'  => $request->approval_message,
                    'file_doc' => $supervisi->file_doc_ped,
                ]);
                $logAdministrasi->save();
                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'TELKOM REGIONAL',
                    'status' => 'DOC VERIFIED',
                    'message'  => $request->approval_message,
                    'file_doc' => $supervisi->file_doc_ped,
                ]);
                $logAdministrasi->save();
            }
            if ($request->approval == 'reject') {
                TranSupervisi::where("project_id", $request->id)
                    ->update([
                        'posisi_doc' => 'MITRA AREA',
                        'progress_doc' => 'REVISI DOC REGIONAL',
                        'status_const' => 'REKON',
                    ]);
                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'MITRA AREA',
                    'status' => 'REVISI DOC REGIONAL',
                    'message'  => $request->approval_message,
                ]);
                $logAdministrasi->save();
                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'MITRA REGIONAL',
                    'status' => 'REJECTED',
                    'message'  => $request->approval_message,
                ]);
                $logAdministrasi->save();
                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'TELKOM REGIONAL',
                    'status' => 'REJECTED',
                    'message'  => $request->approval_message,
                ]);
                $logAdministrasi->save();
            }
        }


        admin_success('Processed successfully.');
        //return response()->json(['success' => 'update administrasi']);
        return redirect()->back();

        //update dokumen di supervisi

    }

    public function SaveApproveBA(Request $request)
    {
        print_r($_POST);
        $supervisi = TranSupervisi::where('project_id', $request->id)->first();
        $baseline = TranBaseline::where('project_id', $supervisi->project_id)->where('activity_id', 22)->first();
        if (Admin::user()->inRoles(['administrator', 'hd-ped'])) {
            $start = strtotime($baseline->actual_start);
            $finish = strtotime(date('Y-m-d'));
            $jarak = $finish - $start;
            $actual_durasi = $jarak / 60 / 60 / 24;
            $actual_durasi = $actual_durasi + 1;
            if ($request->approval == 'approve') {
                TranBaseline::where("id", $baseline->id)
                    ->update([
                        'actual_finish' => date('Y-m-d'),
                        'actual_volume' => 1,
                        'actual_progress' => 100,
                        'actual_durasi' =>  $actual_durasi,
                        'actual_task' =>  'APPROVED',
                        //'actual_evident' => $filepath

                    ]);
                TranSupervisi::where("project_id", $request->id)
                    ->update([
                        'status_doc' => 'FINISH',
                        'posisi_doc' =>  'DOK OK',
                        'progress_doc' => 'FINISH',
                        'task' => 'FINISH',
                        'progress_actual' => 100,
                    ]);
                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'TELKOM REGIONAL',
                    'status' => 'BA VERIFIED',
                    'file_doc' => $baseline->actual_evident,
                    'message'  => $request->approval_message,
                ]);
                $logAdministrasi->save();
            } else if ($request->approval == 'reject') {
                TranBaseline::where("id", $baseline->id)
                    ->update([
                        // 'actual_finish' => date('Y-m-d'),
                        // //'actual_volume' => 1,
                        // 'actual_progress' => 100,
                        // 'actual_durasi' =>  $actual_durasi,
                        'actual_task' =>  'REJECTED',
                        //'actual_evident' => $filepath

                    ]);
                TranSupervisi::where("project_id", $request->id)
                    ->update([
                        'status_doc' => 'ADMINISTRASI',
                        'posisi_doc' =>  'MITRA REGIONAL',
                        'progress_doc' => 'REVISI BA',

                    ]);
                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'TELKOM REGIONAL',
                    'status' => 'REJECTED BA',
                    'message'  => $request->approval_message,
                ]);
                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'MITRA REGIONAL',
                    'status' => 'REVISI BA',
                    'message'  => $request->approval_message,
                ]);
                $logAdministrasi->save();
            }
        }
    }

    public function SaveTtdAdministrasi(Request $request)
    {
        // echo '<pre>';
        // print_r($_POST);
        // print_r($_FILES);
        // echo '</pre>';
        $file = $request->file('file_doc_ttd');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        // File extension
        $extension = $file->getClientOriginalExtension();

        // File upload location
        $location = 'uploads/evident';

        // Upload file
        $file->move($location, $filename);

        // File path
        $filepath = 'evident/' . $filename;

        echo $filepath;
        // die();


        $supervisi = TranSupervisi::where('project_id', $request->id)->first();
        $baseline = TranBaseline::where('project_id', $supervisi->project_id)->where('activity_id', 22)->first();
        if (Admin::user()->inRoles(['witel'])) {
            // if ($supervisi->progress_doc == 'PROSES TANDA TANGAN') {
            TranSupervisi::where("project_id", $request->id)
                ->update([
                    'posisi_doc' => 'MITRA AREA',
                    'progress_doc' => 'PENGIRIMAN DOC KE REGIONAL',
                    'progress_actual' => 98,
                    'status_const' => 'REKON',
                ]);
            // $start = strtotime($baseline->actual_start);
            // $finish = strtotime(date('Y-m-d'));

            // $jarak = $finish - $start;
            // $actual_durasi = $jarak / 60 / 60 / 24;
            // $actual_durasi = $actual_durasi + 1;
            // TranBaseline::where("id", $baseline->id)
            //     ->update([
            //         //'actual_start' => date('Y-m-d'),
            //         'actual_finish' => date('Y-m-d'),
            //         'actual_durasi' => $actual_durasi,
            //         'actual_volume' => 1,
            //         //'actual_progress' => 100,
            //         //'actual_task' =>  'APPROVED',
            //         'approval_message' =>  $request->approval_message,
            //         'actual_task' =>  'APPROVED',

            //     ]);
            $logAdministrasi = TranAdministrasi::create([
                'project_id' => $request->id,
                'status_doc' => 'ADMINISTRASI',
                'posisi_doc' => 'WITEL',
                //'progress_doc' => 'PROSES TANDA TANGAN',
                'status' => 'DOC DITANDA TANGANI',
                'message'  => $request->approval_message,
                'file_doc' => $filepath
            ]);
            $logAdministrasi->save();
            $logAdministrasi = TranAdministrasi::create([
                'project_id' => $request->id,
                'status_doc' => 'ADMINISTRASI',
                'posisi_doc' => 'MITRA AREA',
                //'progress_doc' => 'PROSES TANDA TANGAN',
                'status' => 'PENGIRIMAN DOC KE REGIONAL',
                'message'  => $request->approval_message,
            ]);
            $logAdministrasi->save();
            //} 


        }
        admin_success('Processed successfully.');
        //return response()->json(['success' => 'update administrasi']);
        return redirect()->back();

        //update dokumen di supervisi

    }

    public function SaveTtdBastAdministrasi(Request $request)
    {

        $file = $request->file('file_doc_ttd');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        // File extension
        $extension = $file->getClientOriginalExtension();
        // File upload location
        $location = 'uploads/evident';
        // Upload file
        $file->move($location, $filename);
        // File path
        $filepath = 'evident/' . $filename;
        ///////////////////////////////////////// BAST///////////////////////////////////
        // $file_bast = $request->file('file_bast');
        // $filename_bast = time() . '.' . $file_bast->getClientOriginalExtension();
        // // File extension
        // $extension_bast = $file_bast->getClientOriginalExtension();
        // // File upload location
        // $location_bast = 'uploads/evident';
        // // Upload file
        // $file_bast->move($location_bast, $filename_bast);
        // // File path
        // $filepath_bast = 'evident/' . $filename_bast;

        $supervisi = TranSupervisi::where('project_id', $request->id)->first();

        if (Admin::user()->inRoles(['administrator', 'hd-ped'])) {
            $baseline = TranBaseline::where('project_id', $supervisi->project_id)->where('activity_id', 22)->first();
            // if ($request->approval == 'approve') {
            if ($supervisi->progress_doc == 'PROSES TANDA TANGAN') {
                TranSupervisi::where("project_id", $request->id)
                    ->update([
                        'posisi_doc' => 'MITRA REGIONAL',
                        'progress_doc' => 'PENGIRIMAN BA REKON',
                        //'status_const' => 'BAST-1',
                        //'file_ba_rekon' =>  $filepath_bast,
                        //'progress_actual' => 100,
                        //'status_doc' => 'FINISH'
                    ]);
                // $start = strtotime($baseline->actual_start);
                // $finish = strtotime(date('Y-m-d'));

                // $jarak = $finish - $start;
                // $actual_durasi = $jarak / 60 / 60 / 24;
                // $actual_durasi = $actual_durasi + 1;
                // TranBaseline::where("id", $baseline->id)
                //     ->update([

                //         // 'actual_finish' => date('Y-m-d'),
                //         // 'actual_volume' => 1,
                //         // 'actual_progress' => 100,
                //         // 'actual_durasi' =>  $actual_durasi,
                //         //'actual_task' =>  'APPROVED',
                //         //'actual_evident' => $filepath

                //     ]);
                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'MITRA REGIONAL',
                    'status' => 'PENGIRIMAN BA REKON',
                    'message'  => $request->approval_message,
                ]);
                $logAdministrasi->save();
                $logAdministrasi = TranAdministrasi::create([
                    'project_id' => $request->id,
                    'status_doc' => 'ADMINISTRASI',
                    'posisi_doc' => 'TELKOM REGIONAL',
                    'status' => 'DOC DITANDA TANGANI',
                    'message'  => $request->approval_message,
                    'file_doc' => $filepath
                ]);
                $logAdministrasi->save();
            }
            // }
        }


        admin_success('Processed successfully.');
        //return response()->json(['success' => 'update administrasi']);
        return redirect()->back();

        //update dokumen di supervisi

    }

    public function addBast(Content $content)
    {
        return $content
            ->title('BAST-1')
            ->body(new addBast());
    }
    public function addBarekon(Content $content)
    {
        return $content
            ->title('BAST-1')
            ->body(new addBarekon());
    }
}
