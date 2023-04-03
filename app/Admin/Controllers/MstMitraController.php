<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\MstMitra;
use App\Admin\Actions\Restore;
use Encore\Admin\Facades\Admin;
use App\Admin\Actions\BatchRestore;
use Illuminate\Support\Facades\Hash;
use Encore\Admin\Controllers\AdminController;

class MstMitraController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Tabel Mitra';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MstMitra());
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->scope('trashed', 'Recycle Bin')->onlyTrashed();
            $filter->like('kode_mitra', 'Kode Mitra');
            $filter->like('nama_mitra', 'Nama Mitra');
        });
        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                if (\request('_scope_') == 'trashed') {
                    $batch->disableDelete();
                }               
            });
        });
        $grid->batchActions(function ($batch) {
            if (\request('_scope_') == 'trashed') {
                $batch->add(new BatchRestore());
            }
        });
        $grid->actions(function ($actions) {
            if (!Admin::user()->can('delete-witel')) {
                $actions->disableDelete();
            }
            if (\request('_scope_') == 'trashed') {
                $actions->add(new Restore());
            }
        });

        $grid->column('id', __('Id'));
        $grid->column('kode_mitra', __('Kode mitra'));
        $grid->column('nama_mitra', __('Nama mitra'));
        $grid->column('telepon', __('Telepon'));
        
        $grid->column('mitra_active')->label([
            'n' => 'danger',
            'y' => 'success',
        ]);

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
        $show = new Show(MstMitra::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('kode_mitra', __('Kode mitra'));
        $show->field('nama_mitra', __('Nama mitra'));
        $show->field('avatar', __('Avatar'));
        $show->field('singkatan', __('Singkatan'));
        $show->field('alamat', __('Alamat'));
        $show->field('rt', __('Rt'));
        $show->field('rw', __('Rw'));
        $show->field('kode_pos', __('Kode pos'));
        $show->field('kelurahan', __('Kelurahan'));
        $show->field('kecamatan', __('Kecamatan'));
        $show->field('kabupaten', __('Kabupaten'));
        $show->field('provinsi', __('Provinsi'));
        $show->field('lat', __('Lat'));
        $show->field('lon', __('Lon'));
        $show->field('telepon', __('Telepon'));
        $show->field('fax', __('Fax'));
        $show->field('website', __('Website'));
        $show->field('sosial_media', __('Sosial media'));
        $show->field('remember_token', __('Remember token'));
        $show->field('mitra_active', __('Mitra active'));
        $show->field('username', __('Username'));
        $show->field('email', __('Email'));
        $show->field('password', __('Password'));
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
        $form = new Form(new MstMitra());

        $form->divider('Data Mitra');

        if ($form->isCreating()) {
            $form->text('kode_mitra', __('Kode Mitra'))
            ->creationRules(['required', "unique:mst_mitra"])
            ->updateRules(['required', "unique:mst_mitra,kode_mitra,{{id}}"]);
        }
        if ($form->isEditing()) {
            $form->display('kode_mitra', __('Kode Mitra'));
        }
       
        $form->text('nama_mitra', __('Nama mitra'))->rules('required');

        $form->divider('User Akun');
        
        if ($form->isCreating()) {
            $form->text('username', trans('admin.username'))
            ->creationRules(['required', "unique:mst_mitra"])
            ->updateRules(['required', "unique:mst_mitra,username,{{id}}"]);
        }
        if ($form->isEditing()) {
            $form->display('username', __('admin.username'));
        }
       
        $form->password('password', trans('admin.password'))->rules('required|confirmed');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });

        $form->ignore(['password_confirmation']);

        $states = [
            'off' => ['value' => 'n', 'text' => 'disable', 'color' => 'danger'],
            'on'  => ['value' => 'y', 'text' => 'enable', 'color' => 'success'],
        ];
        $form->switch('mitra_active', 'Mitra Active')->states($states)->rules('required');

        $form->divider('Detail Mitra');
        $form->image('avatar', __('Logo / Foto Mitra'));
        $form->text('singkatan', __('Singkatan'));
        $form->textarea('alamat', __('Alamat'));
        $form->text('rt', __('Rt'));
        $form->text('rw', __('Rw'));
        $form->text('kode_pos', __('Kode pos'));
        $form->text('kelurahan', __('Kelurahan'));
        $form->text('kecamatan', __('Kecamatan'));
        $form->text('kabupaten', __('Kabupaten'));
        $form->text('provinsi', __('Provinsi'));
        $form->latlong('lat', 'lon', 'Koordinat')->default(['lat' => -5.1581227, 'lng' => 119.4491233]);
        $form->text('telepon', __('Telepon'));
        $form->text('fax', __('Fax'));
        $form->text('website', __('Website'));
        $form->text('sosial_media', __('Sosial media'));



        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = Hash::make($form->password);
            }
        });

        return $form;
    }
}
