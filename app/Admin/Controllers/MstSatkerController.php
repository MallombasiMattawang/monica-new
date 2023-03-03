<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\RefKlpd;
use App\Models\MstSatker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Encore\Admin\Controllers\AdminController;

class MstSatkerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Tabel Satuan Kerja';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MstSatker());

        $grid->column('id', __('Id'));
        $grid->column('klpd.nama_klpd', __('K/L/PD'));
        $grid->column('kode_satker', __('Kode satker'));
        $grid->column('nama_satuan_kerja', __('Nama satuan kerja'));
        //$grid->column('foto', __('Logo satker'));
        $grid->column('foto')->display(function ($foto) {
            $pic = Str::replace('.', '-small.', $foto);
            return "<img src='/uploads/$pic' class='img-fluid' width='40' height='40'>";
        });
        $grid->column('satker_active', __('Satker active'));



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
        $show = new Show(MstSatker::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('klpd_id', __('Klpd id'));
        $show->field('kode_satker', __('Kode satker'));
        $show->field('nama_satuan_kerja', __('Nama satuan kerja'));
        $show->field('kependekan', __('Kependekan'));
        $show->field('alamat', __('Alamat'));
        $show->field('rt', __('Rt'));
        $show->field('rw', __('Rw'));
        $show->field('kodepos', __('Kodepos'));
        $show->field('kelurahan', __('Kelurahan'));
        $show->field('kecamatan', __('Kecamatan'));
        $show->field('kabupaten', __('Kabupaten'));
        $show->field('provinsi', __('Provinsi'));
        $show->field('lat', __('Lat'));
        $show->field('lon', __('Lon'));
        $show->field('telepon', __('Telepon'));
        $show->field('fax', __('Fax'));
        $show->field('email', __('Email'));
        $show->field('website', __('Website'));
        $show->field('nama_npwp', __('Nama npwp'));
        $show->field('npwp', __('Npwp'));
        $show->field('norek', __('Norek'));
        $show->field('bank', __('Bank'));
        $show->field('bank_cabang', __('Bank cabang'));
        $show->field('bank_an', __('Bank an'));
        $show->field('username', __('Username'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('foto', __('Logo satker'));
        $show->field('satker_active', __('Satker active'));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new MstSatker());
        $form->column(1 / 2, function ($form) {
            $form->select('klpd_id', 'K/L/PD')->options(
                RefKlpd::where('klpd_active', 'y')
                    ->pluck('nama_klpd', 'id')
            )->setWidth(9, 3);
            $form->text('kode_satker', __('Kode satker'))->setWidth(9, 3);
            $form->text('nama_satuan_kerja', __('Nama satuan kerja'))->setWidth(9, 3);
            $form->text('kependekan', __('Kependekan'))->setWidth(9, 3);
            $form->textarea('alamat', __('Alamat'))->setWidth(9, 3);
            $form->text('rt', __('Rt'))->setWidth(9, 3);
            $form->text('rw', __('Rw'))->setWidth(9, 3);
            $form->text('kodepos', __('Kodepos'))->setWidth(9, 3);
            $form->text('kelurahan', __('Kelurahan'))->setWidth(9, 3);
            $form->text('kecamatan', __('Kecamatan'))->setWidth(9, 3);
            $form->text('kabupaten', __('Kabupaten'))->setWidth(9, 3);
            $form->text('provinsi', __('Provinsi'))->setWidth(9, 3);
            $form->latlong('lat', 'lon', 'Koordinat')->default(['lat' => -5.1581227, 'lng' => 119.4491233])->setWidth(9, 3);
        });
        $form->column(1 / 2, function ($form) {
            $form->text('telepon', __('Telepon'))->setWidth(9, 3);
            $form->text('fax', __('Fax'))->setWidth(9, 3);
            $form->email('email', __('Email'))->setWidth(9, 3);
            $form->text('website', __('Website'))->setWidth(9, 3);
            $form->divider('Pajak Akun');
            $form->text('nama_npwp', __('Nama NPWP'))->setWidth(9, 3);
            $form->text('npwp', __('NPWP'))->setWidth(9, 3);
            $form->divider('Bank Akun');
            $form->text('norek', __('No.rekening'))->setWidth(9, 3);
            $form->text('bank', __('Bank'))->setWidth(9, 3);
            $form->text('bank_cabang', __('Bank cabang'))->setWidth(9, 3);
            $form->text('bank_an', __('Bank atas nama'))->setWidth(9, 3);
            $form->image('foto', 'Logo Satker')
                ->move('images')
                ->uniqueName()
                ->thumbnail('small', 300, 300)
                ->rules([
                    'file' => 'max:2000',
                ])->setWidth(9, 3);

            //if ($form->isCreating()) {
                $form->divider('User Akun');
                $form->text('username', __('Username'))->rules('required')->setWidth(9, 3);
                $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
                    ->default(function ($form) {
                        return $form->model()->password;
                    })->setWidth(9, 3);

                $form->ignore(['password_confirmation']);
            //}
        });

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = Hash::make($form->password);
            }
        });
        return $form;
    }
}
