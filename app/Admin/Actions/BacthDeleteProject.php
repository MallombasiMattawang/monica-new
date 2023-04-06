<?php 

namespace App\Admin\Actions;

use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;

class BacthDeleteProject extends BatchAction
{
    public $name = 'Batch Delete Project';

    public function handle (Collection $collection)
    {
        
        foreach ($collection as $model) {
            if ($model->status_project == 'USULAN') {
                $model->delete();
            }
           
            // activity()
            //     ->performedOn($model)
            //     ->causedBy(auth()->user())
            //     ->inLog('user')
            //     ->log(__('has permanently deleted'));
        }

        return $this->response()->success(__('Deleted Project, untuk menghapus permanen / restore project masuk ke rycle bin'))->refresh();
    }

    public function dialog ()
    {
        $this->confirm('Anda ingin menghapus data project ? <br> hanya data dengan status "USULAN" yang dapat dihapus');
    }
}