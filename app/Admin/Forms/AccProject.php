<?php

namespace App\Admin\Forms;

use App\Models\MstProject;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\Box;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class AccProject extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Update Pelaksana';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        //dump($request->all());

        admin_success('Processed ACC Selesai, kamu sudah bisa membuat baseline pada project ini');
        MstProject::where("id", $request->id)
            ->update([
                'nde_pelimpahan' => $request->nde_pelimpahan,  
                'nomor_kontrak' => $request->nomor_kontrak,  
                'status_sap' => $request->status_sap,  
                'start_date' => $request->start_date, 
                'end_date' => $request->end_date,          
                'status_project' => $request->status_project,
            ]);


        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        
        $this->hidden('id');
        $this->text('lop_site_id', __('Lop site id'))->readOnly();
        // $this->text('mitra_id', __('Mitra id'));
        $this->text('mitra_id', 'MITRA')->readOnly();

        $this->divider();

        $this->text('nde_pelimpahan', __('NDE Pelimpahan'));
        $this->text('nomor_kontrak', __('Nomor Kontrak'));
        $this->select('status_sap', __('Status SAP'))->options(['PR' => 'PR', 'PO' => 'PO', 'GR' => 'GR']);
        $this->dateRange('start_date', 'end_date', 'Date range Project');
        $this->select('status_project', __('Status Project'))->options(['USULAN' => 'USULAN', 'DONE DRM' => 'DONE DRM', 'PO/SP' => 'PO/SP', 'PELIMPAHAN' => 'PELIMPAHAN', 'DROP' => 'DROP']);
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        $id = $_GET['id'];
        $project = MstProject::findOrFail($id);
        return [
            'id' => $project->id,
            'lop_site_id'   => $project->lop_site_id,
            'mitra_id'       => $project->mitra_id,
            'status_project' => $project->status_project,
            'start_date' => $project->start_date,
            'end_date' => $project->end_date,
            'status_sap' => $project->status_sap,
            'nomor_kontrak' => $project->nomor_kontrak,
            'nde_pelimpahan' => $project->nde_pelimpahan,
        ];
    }
}
