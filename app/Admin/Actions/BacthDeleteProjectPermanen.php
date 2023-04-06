<?php 

namespace App\Admin\Actions;

use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;

class BacthDeleteProjectPermanen extends BatchAction
{
    public $name = 'Batch Delete Permanen';

    public function handle (Collection $collection)
    {
        
        foreach ($collection as $model) {
            if ($model->status_project == 'USULAN') {
                $model->forceDelete();
            }
           
            // activity()
            //     ->performedOn($model)
            //     ->causedBy(auth()->user())
            //     ->inLog('user')
            //     ->log(__('has permanently deleted'));
        }

        return $this->response()->success(__('Deleted Project, Project dihapus permanen'))->refresh();
    }

    public function dialog ()
    {
        $this->confirm('Anda ingin menghapus data project secara permanen ? ');
    }
}