<?php

namespace App\Admin\Actions\Project;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Odp extends RowAction
{
    public $name = 'Generate ODP';

    public function handle(Model $model)
    {
        // $model ...

        return $this->response()->info('Generator ODP')->redirect('tran-inventory/'.$model->id);
    }

}