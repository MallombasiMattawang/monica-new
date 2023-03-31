<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
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
            $grid->model()->where('witel_id', '=', Admin::user()->username);
        }

        $grid->column('id', __('Id'));
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
        $log_administrasi = LogAdministrasi::where('tran_administrasi_id', $administrasi->id)->get();

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
        // UPDATE ACTUAL DI TRANSADMINISTRASI    
        TranAdministrasi::where("id", $request->id)
            ->update([
                'status_ba_rekon' =>  'APPROVAL',
                'catatan_verifikator' =>  $request->catatan_verifikator,
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
        // UPDATE ACTUAL DI TRANSADMINISTRASI    
        TranAdministrasi::where("id", $request->id)
            ->update([
                'status_ba_rekon' =>  'REJECTED',
                'catatan_verifikator' =>  $request->catatan_verifikator,

            ]);
      
        admin_success('Rejected Approval BA Rekon Success!');
        admin_toastr('Rejected Approval BA Rekon Success!', 'success');
        return back();
    }
}
