<?php

namespace App\Admin\Actions\Project;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Acc extends RowAction
{
    public $name = 'ACC Project';

    public function handle(Model $model)
    {
        // $model ...
        

       return $this->response()->info('Mulai Proses ACC')->redirect('acc-project?id='.$model->id);
        //return redirect('acc-project?id='.$model->id);
    }

    

}