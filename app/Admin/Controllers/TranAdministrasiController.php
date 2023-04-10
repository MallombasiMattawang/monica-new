<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\MstMitra;
use App\Models\MstWitel;
use App\Models\TranBaseline;
use Illuminate\Http\Request;
use App\Models\TranSupervisi;
use App\Models\LogAdministrasi;
use Encore\Admin\Facades\Admin;
use App\Models\TranAdministrasi;
use Encore\Admin\Controllers\AdminController;


class TranAdministrasiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Actual Administrasi';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TranAdministrasi());
        if (Admin::user()->inRoles(['witel'])) {
            $grid->model()->where('witel_id', '=', Admin::user()->id);
        }
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
              $filter->like('project_name', 'LOP / SITE ID');
              $filter->in('project.tematik', 'TEMATIK')->multipleSelect(['PT3' => 'PT3', 'PT2' => 'PT2', 'NODE-B' => 'NODE-B', 'OLO' => 'OLO', 'HEM' => 'HEM', 'ISP' => 'ISP', 'FTTH 2022' => 'FTTH 2022']);
              $filter->in('witel_id', 'WITEL')->multipleSelect(
                MstWitel::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
                  ->where('admin_role_users.role_id', '2')->pluck('name', 'id')
              );
              $filter->in('mitra_id', 'MITRA')->multipleSelect(
                MstMitra::pluck('nama_mitra', 'id')
              );
            });
      
            $filter->column(1 / 2, function ($filter) {
              $filter->like('supervisi_project.sto_id', 'STO');
            });
          });
        $grid->disableCreateButton();
        $grid->column('id', __('Id'));
        $grid->column('project.tematik', __('Tematik'));
        $grid->column('witel.name', __('Witel'));
        $grid->column('project.lop_site_id', __('LOP SITE ID'));
        $grid->column('mitra.nama_mitra', __('Mitra'));
        $grid->column('status_doc', __('Status doc'));
        $grid->column('posisi_doc', __('Posisi doc'));
        // $grid->column('file_doc', __('File doc'));
        // $grid->column('remarks', __('Remarks'));
        // $grid->column('status_verfy', __('Status verfy'));
        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $actions->disableDelete();
        });
        $grid->fixColumns(2, -1);

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $administrasi = TranAdministrasi::findOrFail($id);
        $log_administrasi = LogAdministrasi::where('tran_administrasi_id', $administrasi->id)->orderBy('id', 'desc')->get();

        return view('admin.modules.administrasi.detail', [
            'administrasi' => $administrasi,
            'log_administrasi' => $log_administrasi
        ]);
    }

    protected function approveWitel(Request $request)
    {
        $request->validate([
            'id' =>  'required',
            'catatan_verifikator' => 'required'
        ]);
        $baseline = TranAdministrasi::where('id', $request->id)->first();
        // UPDATE ACTUAL DI TRANSADMINISTRASI    
        TranAdministrasi::where("id", $request->id)
            ->update([
                'status_doc' => 'PROSES TANDA TANGAN WITEL',
                'posisi_doc' => 'WITEL',
                'catatan_verifikator' =>  $request->catatan_verifikator,
                'status_verfy' =>  'APPROVAL WITEL',

            ]);
        // UPDATE ACTUAL DI LOG ADMINISTRASI    
        LogAdministrasi::create([
            'tran_administrasi_id' => $request->id,
            'status_doc' => 'PROSES TANDA TANGAN WITEL',
            'posisi_doc' => 'WITEL',
            'catatan_verifikator' => $request->catatan_verifikator,
            'status_verfy' => 'APPROVAL WITEL',
        ]);
        // UPDATE ACTUAL DI SUPERIVSI    
        TranSupervisi::where("project_id", $baseline->project_id)
            ->update([
                'task' => 'Verifikasi Dokumen di Witel Berhasil, mohon tunggu proses penandatanganan dokumen',
                'status_doc' => 'PROSES TANDA TANGAN WITEL',
                'posisi_doc' => 'WITEL',
                'status_const' => 'REKON'
            ]);

        admin_success('Approval Witel Success!');
        admin_toastr('Approval Witel Success!', 'success');
        return back();
    }

    protected function rejectWitel(Request $request)
    {
        $request->validate([
            'id' =>  'required',
            'catatan_verifikator' => 'required'
        ]);
        $baseline = TranAdministrasi::where('id', $request->id)->first();
        // UPDATE ACTUAL DI TRANSADMINISTRASI    
        TranAdministrasi::where("id", $request->id)
            ->update([
                'status_doc' => 'REVISI DOKUMEN',
                'posisi_doc' => 'MITRA AREA',
                'catatan_verifikator' =>  $request->catatan_verifikator,
                'status_verfy' =>  'REJECTED WITEL',

            ]);
        // UPDATE ACTUAL DI LOG ADMINISTRASI    
        LogAdministrasi::create([
            'tran_administrasi_id' => $request->id,
            'status_doc' => 'REVISI DOKUMEN',
            'posisi_doc' => 'MITRA AREA',
            'catatan_verifikator' => $request->catatan_verifikator,
            'status_verfy' => 'REJECTED WITEL',
        ]);
        // UPDATE ACTUAL DI SUPERIVSI    
        TranSupervisi::where("project_id", $baseline->project_id)
            ->update([
                'task' => 'Dokumen ditolak mohon periksa catatan verifikator pada timeline Administrasi Actual',
                'status_doc' => 'REVISI DOKUMEN',
                'posisi_doc' => 'MITRA AREA',
            ]);
        admin_success('Rejected Witel Success!');
        admin_toastr('Rejected Witel Success!', 'success');
        return back();
    }

    protected function ttdWitel(Request $request)
    {
        $request->validate([
            'id' =>  'required',
            'catatan_verifikator' => 'required',
            'file_doc' => 'required|mimes:pdf,PDF|max:25000',
        ]);
        // menangkap file 
        $file = $request->file('file_doc');
        // membuat nama file unik
        $nama_file = now()->timestamp . '.' . $file->getClientOriginalExtension();
        // upload ke folder public
        $file->move('uploads/administrasi', $nama_file);
        // File path
        $filepath = 'administrasi/' . $nama_file;
        $baseline = TranAdministrasi::where('id', $request->id)->first();
        // UPDATE ACTUAL DI TRANSADMINISTRASI    
        TranAdministrasi::where("id", $request->id)
            ->update([
                'status_doc' => 'PENGIRIMAN DOKUMEN KE REGIONAL',
                'posisi_doc' => 'MITRA AREA',
                'file_doc' => $filepath,
                'catatan_verifikator' =>  $request->catatan_verifikator,
                'status_verfy' =>  'PENANDATANGANAN WITEL',

            ]);
        // UPDATE ACTUAL DI LOG ADMINISTRASI    
        LogAdministrasi::create([
            'tran_administrasi_id' => $request->id,
            'status_doc' => 'PENGIRIMAN DOKUMEN KE REGIONAL',
            'posisi_doc' => 'MITRA AREA',
            'file_doc' => $filepath,
            'catatan_verifikator' => $request->catatan_verifikator,
            'status_verfy' => 'PENANDATANGANAN WITEL',
        ]);
        TranSupervisi::where("project_id", $baseline->project_id)
            ->update([
                'task' => 'Dokumen ditandatangani WITEL, silahkan download pada timeline Administrasi Activity dan lanjutkan pengiriman dok ke Regional',
                'status_doc' => 'PENGIRIMAN DOKUMEN KE REGIONAL',
                'posisi_doc' => 'MITRA AREA',
            ]);
        admin_success('PENANDATANGANAN WITEL Success!');
        admin_toastr('PENANDATANGANAN WITEL Success!', 'success');
        return back();
    }

    protected function approveRegional(Request $request)
    {
        $request->validate([
            'id' =>  'required',
            'catatan_verifikator' => 'required'
        ]);
        $baseline = TranAdministrasi::where('id', $request->id)->first();
        // UPDATE ACTUAL DI TRANSADMINISTRASI    
        TranAdministrasi::where("id", $request->id)
            ->update([
                'status_doc' => 'PROSES TANDA TANGAN TELKOM REGIONAL',
                'posisi_doc' => 'TELKOM REGIONAL',
                'catatan_verifikator' =>  $request->catatan_verifikator,
                'status_verfy' =>  'APPROVAL TELKOM REGIONAL',

            ]);
        // UPDATE ACTUAL DI LOG ADMINISTRASI    
        LogAdministrasi::create([
            'tran_administrasi_id' => $request->id,
            'status_doc' => 'PROSES TANDA TANGAN TELKOM REGIONAL',
            'posisi_doc' => 'TELKOM REGIONAL',
            'catatan_verifikator' =>  $request->catatan_verifikator,
            'status_verfy' =>  'APPROVAL TELKOM REGIONAL',
        ]);
        TranSupervisi::where("project_id", $baseline->project_id)
            ->update([
                'task' => 'Verifikasi Dokumen di T.Reg Berhasil, mohon tunggu proses penandatanganan dokumen',
                'status_doc' => 'PROSES TANDA TANGAN TELKOM REGIONAL',
                'posisi_doc' => 'TELKOM REGIONAL',
            ]);
        admin_success('Approval TELKOM REGIONAL Success!');
        admin_toastr('Approval TELKOM REGIONAL Success!', 'success');
        return back();
    }

    protected function rejectRegional(Request $request)
    {
        $request->validate([
            'id' =>  'required',
            'catatan_verifikator' => 'required'
        ]);
        $baseline = TranAdministrasi::where('id', $request->id)->first();
        // UPDATE ACTUAL DI TRANSADMINISTRASI    
        TranAdministrasi::where("id", $request->id)
            ->update([
                'status_doc' => 'REVISI DOKUMEN',
                'posisi_doc' => 'MITRA AREA',
                'catatan_verifikator' =>  $request->catatan_verifikator,
                'status_verfy' =>  'REJECTED TELKOM REGIONAL',

            ]);
        // UPDATE ACTUAL DI LOG ADMINISTRASI    
        LogAdministrasi::create([
            'tran_administrasi_id' => $request->id,
            'status_doc' => 'REVISI DOKUMEN',
            'posisi_doc' => 'MITRA AREA',
            'catatan_verifikator' => $request->catatan_verifikator,
            'status_verfy' => 'REJECTED TELKOM REGIONAL',
        ]);
        // UPDATE ACTUAL DI SUPERIVSI    
        TranSupervisi::where("project_id", $baseline->project_id)
            ->update([
                'task' => 'Dokumen ditolak mohon periksa catatan verifikator pada timeline Administrasi Actual',
                'status_doc' => 'REVISI DOKUMEN',
                'posisi_doc' => 'MITRA AREA',
            ]);
        admin_success('Rejected REGIONAL Success!');
        admin_toastr('Rejected REGIONAL Success!', 'success');
        return back();
    }

    protected function ttdRegional(Request $request)
    {
        $request->validate([
            'id' =>  'required',
            'catatan_verifikator' => 'required',
            'file_doc' => 'required|mimes:pdf,PDF|max:25000',
        ]);
        // menangkap file 
        $file = $request->file('file_doc');
        // membuat nama file unik
        $nama_file = now()->timestamp . '.' . $file->getClientOriginalExtension();
        // upload ke folder public
        $file->move('uploads/administrasi', $nama_file);
        // File path
        $filepath = 'administrasi/' . $nama_file;
        $baseline = TranAdministrasi::where('id', $request->id)->first();

        // UPDATE ACTUAL DI TRANSADMINISTRASI    
        TranAdministrasi::where("id", $request->id)
            ->update([
                'status_doc' => 'DOKUMEN OK',
                'posisi_doc' => 'TELKOM REGIONAL',
                'file_doc' => $filepath,
                'catatan_verifikator' =>  $request->catatan_verifikator,
                'status_verfy' =>  'PENANDATANGANAN TELKOM REGIONAL',

            ]);
        // UPDATE ACTUAL DI LOG ADMINISTRASI    
        LogAdministrasi::create([
            'tran_administrasi_id' => $request->id,
            'status_doc' => 'DOKUMEN OK',
            'posisi_doc' =>  'TELKOM REGIONAL',
            'file_doc' => $filepath,
            'catatan_verifikator' => $request->catatan_verifikator,
            'status_verfy' =>  'PENANDATANGANAN TELKOM REGIONAL',
        ]);
        TranSupervisi::where("project_id", $baseline->project_id)
            ->update([
                'task' => 'Dokumen ditandatangani T.REG, silahkan download pada timeline Administrasi Activity dan lanjutkan pengiriman BA Rekon ke Regional',
                'status_doc' => 'DOKUMEN OK',
                'posisi_doc' =>  'TELKOM REGIONAL',
            ]);
        admin_success('PENANDATANGANAN TELKOM REGIONAL Success!');
        admin_toastr('PENANDATANGANAN TELKOM REGIONAL Success!', 'success');
        return back();
    }

    protected function approveBa(Request $request)
    {
        $request->validate([
            'id' =>  'required',
            'catatan_verifikator' => 'required'
        ]);
        $baseline = TranAdministrasi::where('id', $request->id)->first();
        $baseline2 = TranBaseline::where('project_id', $baseline->project_id)->first();
        $actual_finish = date('Y-m-d');
        $start = strtotime($baseline2->actual_start);
        $finish = strtotime($actual_finish);

        $jarak = $finish - $start;
        $actual_durasi = $jarak / 60 / 60 / 24;
        $actual_durasi = $actual_durasi + 1;
        
        // UPDATE ACTUAL DI TRANSADMINISTRASI    
        TranAdministrasi::where("id", $request->id)
            ->update([
                'status_ba_rekon' =>  'APPROVAL',
                'catatan_verifikator' =>  $request->catatan_verifikator,
            ]);
        TranSupervisi::where("project_id", $baseline->project_id)
            ->update([
                'task' => 'Verifikasi BA REKON di T.Reg Berhasil, mohon tunggu proses BAST-1 selesai',
                'tgl_rekon' => date('Y-m-d'),
                'status_const' => 'SELESAI REKON',
                'file_ba_rekon' => $baseline->file_ba_rekon,
            ]);
        TranBaseline::where("activity_id", 22)
            ->update([
                'actual_finish' =>  date('Y-m-d'),
                'actual_task' =>  'APPROVED',
                'actual_volume' => 1,
                'actual_progress' =>  100,
                'progress_bobot' => 100,
                'actual_durasi' => $actual_durasi,

            ]);

        admin_success('Approval BA Rekon Success!');
        admin_toastr('Approval BA Rekon Success!', 'success');
        return back();
    }

    protected function rejectBa(Request $request)
    {
        $request->validate([
            'id' =>  'required',
            'catatan_verifikator' => 'required'
        ]);
        $baseline = TranAdministrasi::where('id', $request->id)->first();
        // UPDATE ACTUAL DI TRANSADMINISTRASI    
        TranAdministrasi::where("id", $request->id)
            ->update([
                'status_ba_rekon' =>  'REJECTED',
                'catatan_verifikator' =>  $request->catatan_verifikator,

            ]);
        TranSupervisi::where("project_id", $baseline->project_id)
            ->update([
                'task' => 'Verifikasi BA REKON di T.Reg ditolak, mohon periksa kembali dokumen BA Rekon '
            ]);

        admin_success('Rejected Approval BA Rekon Success!');
        admin_toastr('Rejected Approval BA Rekon Success!', 'success');
        return back();
    }
}
