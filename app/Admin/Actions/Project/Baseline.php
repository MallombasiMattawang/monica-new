<?php

namespace App\Admin\Actions\Project;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Baseline extends RowAction
{
    public $name = 'Baseline Activity';

    public function handle(Model $model)
    {
        // $model ...

        
        return $this->response()->info('Lembar Kerja Baseline Activity')->redirect('form-baseline/'.$model->project_id);
    }

}