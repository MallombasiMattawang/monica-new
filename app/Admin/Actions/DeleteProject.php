<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class DeleteProject extends RowAction
{
    public $name = 'Delete';

    public function handle (Model $model)
    {
        if ($model->status_project == 'USULAN') {
            $model->delete();
        }

        return $this->response()->success('Deleted')->refresh();
    }

    public function dialog()
    {
        $this->confirm(__('Are you sure you want to delete ?'));
    }
}