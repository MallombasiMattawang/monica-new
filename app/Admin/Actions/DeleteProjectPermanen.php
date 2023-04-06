<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class DeleteProjectPermanen extends RowAction
{
    public $name = 'Delete Permanen';

    public function handle (Model $model)
    {
        if ($model->status_project == 'USULAN') {
            $model->forceDelete();
        }

        return $this->response()->success('Deleted')->refresh();
    }

    public function dialog()
    {
        $this->confirm(__('Are you sure you want to delete permanently?'));
    }
}