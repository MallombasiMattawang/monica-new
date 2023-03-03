<?php

namespace App\Admin\Actions\Project;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Approval extends RowAction
{
    public $name = 'Approval Activity';

    public function handle(Model $model)
    {
        // $model ...

        return $this->response()->info('Lembar Kerja Approval Activity')->redirect('add-approve?id='.$model->log_actual->tran_baseline_id);
       
    }

}