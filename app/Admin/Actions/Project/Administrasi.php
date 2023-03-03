<?php

namespace App\Admin\Actions\Project;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends RowAction
{
    public $name = 'Actual Administration';

    public function handle(Model $model)
    {
        // $model ...

        return $this->response()->info('Lembar Kerja Approval Activity')->redirect('administrasi-generate?id='.$model->project_id);
    }

}