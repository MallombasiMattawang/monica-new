<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\MstWitel;
use App\Admin\Actions\Restore;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Permission;
use App\Admin\Actions\BatchRestore;
use Illuminate\Support\Facades\Hash;
use Encore\Admin\Controllers\AdminController;

class MstWitelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Data Witel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MstWitel());
        $grid->model()->join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')->where('role_id', '=',  2);
        $grid->filter(function ($filter) {
            $filter->scope('trashed', 'Recycle Bin')->onlyTrashed();
            $filter->disableIdFilter();
            $filter->like('name', 'Nama Witel');
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

        $grid->actions (function ($actions) {
            if (!Admin::user()->can('delete-witel')) {
                $actions->disableDelete();
            }
            if (\request('_scope_') == 'trashed') {
                $actions->add(new Restore());
            }
        });
        $grid->column('id', 'ID')->sortable();
        $grid->column('kode_user', 'Kode User');
        $grid->column('name', trans('admin.name'));

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
        $show = new Show(MstWitel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('kode_user', __('Kode Witel'));
        $show->field('name', __('Nama WITEL'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        Permission::check('create-witel');
        $userModel = config('admin.database.users_model');
        $permissionModel = config('admin.database.permissions_model');
        $roleModel = config('admin.database.roles_model');

        $form = new Form(new $userModel());

        $userTable = config('admin.database.users_table');
        $connection = config('admin.database.connection');

        $form->display('id', 'ID');
        $form->text('username', trans('admin.username'))
            ->creationRules(['required', "unique:{$connection}.{$userTable}"])
            ->updateRules(['required', "unique:{$connection}.{$userTable},username,{{id}}"]);

        $form->text('name', trans('admin.name'))->rules('required');
        $form->text('kode_user', 'Kode User');

        $form->image('avatar', trans('admin.avatar'));
        $form->password('password', trans('admin.password'))->rules('required|confirmed');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });

        $form->ignore(['password_confirmation']);
        $form->multipleSelect('roles', trans('admin.roles'))->options($roleModel::where('id', '=',  2)->pluck('name', 'id'))->rules('required');
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
