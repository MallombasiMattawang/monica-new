<?php

namespace App\Admin\Actions\Project;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Plan extends RowAction
{
    public $name = 'Plan Activity';

    public function handle(Model $model)
    {
        // $model ...

        return $this->response()->info('Lembar Kerja Plan Activity')->redirect('plan-generate?id='.$model->project_id);
    }

}