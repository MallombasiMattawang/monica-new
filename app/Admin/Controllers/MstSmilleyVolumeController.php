<?php

namespace App\Admin\Controllers;

use App\Models\MstSmilleyVolume;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MstSmilleyVolumeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Tabel Smilley Volume';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new MstSmilleyVolume());
        $grid->disableActions();

        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableExport();
        $grid->disableColumnSelector();
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
                $filter->like('kt_lokasi', 'KT lokasi / Lop Site ID');
            });

            
        });
        $grid->tools(function ($tools) {
            $tools->append('<a href="/ped-panel/mst-smilleys" class="btn btn-default btn-sm"><i class="fa fa-database"></i>&nbsp;&nbsp; Smilley Nilai</a>');
            $tools->append('<a href="/ped-panel/mst-smilley-volumes" class="btn btn-default btn-sm"><i class="fa fa-database"></i>&nbsp;&nbsp; Smilley Volume</a>');
            $tools->append('<a href="/ped-panel/form-import-smilley" class="btn btn-default btn-sm"><i class="fa fa-download"></i>&nbsp;&nbsp; Import Tabel Smilley</a>');
        });

        $grid->column('id', __('Id'))->sortable();
        $grid->column('kd_kontrak', __('Kd kontrak'))->sortable();
        $grid->column('no_amdke', __('No amdke'))->sortable();
        $grid->column('kd_wbs', __('Kd wbs'))->sortable();
        $grid->column('kd_sgrup', __('Kd sgrup'))->sortable();
        $grid->column('pk_owner', __('Pk owner'))->sortable();
        $grid->column('kd_lokasi1', __('Kd lokasi1'))->sortable();
        $grid->column('ubis_waslak', __('Ubis waslak'))->sortable();
        $grid->column('unit_waslak', __('Unit waslak'))->sortable();
        $grid->column('waslak_har', __('Waslak har'))->sortable();
        $grid->column('ubis_owner', __('Ubis owner'))->sortable();
        $grid->column('no_kontrak', __('No kontrak'))->sortable();
        $grid->column('nm_singkat', __('Nm singkat'))->sortable();
        $grid->column('tg_edc', __('Tg edc'))->sortable();
        $grid->column('tg_toc', __('Tg toc'))->sortable();
        $grid->column('nm_tematik', __('Nm tematik'))->sortable();
        $grid->column('nm_witel', __('Nm witel'))->sortable();
        $grid->column('nm_lokasi1', __('Nm lokasi1'))->sortable();
        $grid->column('project_site_id', __('Project site id'))->sortable();
        $grid->column('kt_lokasi', __('Kt lokasi'))->sortable();
        $grid->column('site_alamat', __('Site alamat'))->sortable();
        $grid->column('pro_plan', __('Pro plan'))->sortable();
        $grid->column('pro_actual', __('Pro actual'))->sortable();
        $grid->column('pro_bast', __('Pro bast'))->sortable();
        $grid->column('status', __('Status'))->sortable();
        $grid->column('tg_plan_start', __('Tg plan start'))->sortable();
        $grid->column('tg_plan_finish', __('Tg plan finish'))->sortable();
        $grid->column('tg_actual_start', __('Tg actual start'))->sortable();
        $grid->column('no_ut', __('No ut'))->sortable();
        $grid->column('tg_ut', __('Tg ut'))->sortable();
        $grid->column('no_bast1', __('No bast1'))->sortable();
        $grid->column('tg_baut', __('Tg baut'))->sortable();
        $grid->column('nm_inf', __('Nm inf'))->sortable();
        $grid->column('ni_kap_real', __('Ni kap real'))->sortable();
        $grid->column('ni_kap_sls', __('Ni kap sls'))->sortable();
        $grid->column('satuan', __('Satuan'))->sortable();
        $grid->column('kt_volume', __('Kt volume'))->sortable();
        $grid->column('nm_vendor', __('Nm vendor'))->sortable();
        $grid->column('tg_bast1', __('Tg bast1'))->sortable();
        $grid->fixColumns(4, -2);

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
        $show = new Show(MstSmilleyVolume::findOrFail($id));

        $show->field('id', __('Id'));
        // $show->field('kd_kontrak', __('Kd kontrak'));
        // $show->field('no_amdke', __('No amdke'));
        // $show->field('kd_wbs', __('Kd wbs'));
        // $show->field('kd_sgrup', __('Kd sgrup'));
        // $show->field('pk_owner', __('Pk owner'));
        // $show->field('kd_lokasi1', __('Kd lokasi1'));
        // $show->field('ubis_waslak', __('Ubis waslak'));
        // $show->field('unit_waslak', __('Unit waslak'));
        // $show->field('waslak_har', __('Waslak har'));
        // $show->field('ubis_owner', __('Ubis owner'));
        // $show->field('no_kontrak', __('No kontrak'));
        $show->field('nm_singkat', __('Nm singkat'));
        $show->field('tg_edc', __('Tg edc'));
        $show->field('tg_toc', __('Tg toc'));
        $show->field('nm_tematik', __('Nm tematik'));
        $show->field('nm_witel', __('Nm witel'));
        $show->field('nm_lokasi1', __('Nm lokasi1'));
        $show->field('project_site_id', __('Project site id'));
        $show->field('kt_lokasi', __('Kt lokasi'));
        $show->field('site_alamat', __('Site alamat'));
        $show->field('pro_plan', __('Pro plan'));
        $show->field('pro_actual', __('Pro actual'));
        $show->field('pro_bast', __('Pro bast'));
        $show->field('status', __('Status'));
        $show->field('tg_plan_start', __('Tg plan start'));
        $show->field('tg_plan_finish', __('Tg plan finish'));
        $show->field('tg_actual_start', __('Tg actual start'));
        $show->field('no_ut', __('No ut'));
        $show->field('tg_ut', __('Tg ut'));
        $show->field('no_bast1', __('No bast1'));
        $show->field('tg_baut', __('Tg baut'));
        $show->field('nm_inf', __('Nm inf'));
        $show->field('ni_kap_real', __('Ni kap real'));
        $show->field('ni_kap_sls', __('Ni kap sls'));
        $show->field('satuan', __('Satuan'));
        $show->field('kt_volume', __('Kt volume'));
        $show->field('nm_vendor', __('Nm vendor'));
        $show->field('tg_bast1', __('Tg bast1'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new MstSmilleyVolume());

        $form->text('kd_kontrak', __('Kd kontrak'));
        $form->text('no_amdke', __('No amdke'));
        $form->text('kd_wbs', __('Kd wbs'));
        $form->text('kd_sgrup', __('Kd sgrup'));
        $form->text('pk_owner', __('Pk owner'));
        $form->text('kd_lokasi1', __('Kd lokasi1'));
        $form->text('ubis_waslak', __('Ubis waslak'));
        $form->text('unit_waslak', __('Unit waslak'));
        $form->text('waslak_har', __('Waslak har'));
        $form->text('ubis_owner', __('Ubis owner'));
        $form->text('no_kontrak', __('No kontrak'));
        $form->text('nm_singkat', __('Nm singkat'));
        $form->text('tg_edc', __('Tg edc'));
        $form->text('tg_toc', __('Tg toc'));
        $form->text('nm_tematik', __('Nm tematik'));
        $form->text('nm_witel', __('Nm witel'));
        $form->text('nm_lokasi1', __('Nm lokasi1'));
        $form->text('project_site_id', __('Project site id'));
        $form->text('kt_lokasi', __('Kt lokasi'));
        $form->text('site_alamat', __('Site alamat'));
        $form->text('pro_plan', __('Pro plan'));
        $form->text('pro_actual', __('Pro actual'));
        $form->text('pro_bast', __('Pro bast'));
        $form->text('status', __('Status'));
        $form->text('tg_plan_start', __('Tg plan start'));
        $form->text('tg_plan_finish', __('Tg plan finish'));
        $form->text('tg_actual_start', __('Tg actual start'));
        $form->text('no_ut', __('No ut'));
        $form->text('tg_ut', __('Tg ut'));
        $form->text('no_bast1', __('No bast1'));
        $form->text('tg_baut', __('Tg baut'));
        $form->text('nm_inf', __('Nm inf'));
        $form->text('ni_kap_real', __('Ni kap real'));
        $form->text('ni_kap_sls', __('Ni kap sls'));
        $form->text('satuan', __('Satuan'));
        $form->text('kt_volume', __('Kt volume'));
        $form->text('nm_vendor', __('Nm vendor'));
        $form->text('tg_bast1', __('Tg bast1'));

        return $form;
    }
}
