<?php

namespace App\Admin\Actions\Project;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Actual extends RowAction
{
    public $name = 'Actual Activity';

    public function handle(Model $model)
    {
        // $model ...

        return $this->response()->info('Lembar Kerja Actual Activity')->redirect('actual-generate/'.$model->project_id);
    }

}