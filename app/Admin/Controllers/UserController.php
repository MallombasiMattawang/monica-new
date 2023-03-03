<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;
use Encore\Admin\Controllers\AdminController;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Daftar Verifikator';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('Name', 'name');
        });

        $grid->column('id', 'ID')->sortable();
        $grid->column('nik', __('NIK'));
        $grid->column('name', __('Nama Verifikator'));
        $grid->column('telepon', __('Telp/WA'));
        $grid->column('email', trans('email'));
        $grid->column('role')->label([
            'waspang' => 'danger',
            'tim_ut' => 'success',
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->column('nik', __('NIK'));
        $show->column('name', __('Nama Verifikator'));
        $show->column('telepon', __('Telp/WA'));
        $show->column('email', trans('email'));
        $show->field('role', __('Role'));
        $show->field('foto', __('Foto'));
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
        $form = new Form(new User());

        $connection = config('admin.database.connection');
        $form->text('nik', __('Nik'))
            ->creationRules(['required', "unique:users"])
            ->updateRules(['required', "unique:users,nik,{{id}}"]);
        $form->text('name', trans('admin.name'))->rules('required');
        $form->text('telepon', __('Telp/WA'))->rules('required');
        $form->image('foto', trans('Foto'));
        $form->select('role', trans('admin.roles'))->options(['waspang' => 'Waspang', 'tim_ut' => 'Tim UT'])->rules('required');
        $form->text('email', trans('Email'))
            ->creationRules(['required', "unique:users"])
            ->updateRules(['required', "unique:users,email,{{id}}"]);
        $form->text('username', __('Username'))
            ->creationRules(['required', "unique:users"])
            ->updateRules(['required', "unique:users,username,{{id}}"]);
        $form->password('password', trans('admin.password'))->rules('required|confirmed');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });

        $form->ignore(['password_confirmation']);




        $form->display('created_at', trans('admin.created_at'));
        $form->display('updated_at', trans('admin.updated_at'));

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = Hash::make($form->password);
            }
        });

        return $form;
    }
}
