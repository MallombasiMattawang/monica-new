<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranBaseline extends Model
{
    use HasFactory;

    protected $table = 'tran_baseline';

    protected $fillable = [
        'project_id', 
        'activity_id',
        'category_id',
        'list_activity', 
        'bobot', 
        'volume', 
        'satuan', 
        'durasi', 
        'plan_start', 
        'plan_finish', 
        'plam_durasi',
        'actual_start', 
        'actual_finish',
        'actual_durasi',
        'actual_volume',
        'actual_progress',
        'actual_evident',
        'actual_status',
        'actual_task',
        'actual_message',
        'actual_kendala',
        'approval_waspang',
        'approval_tim_ut',
        'approval_message',
        'supervisi_status',
        'waspang_by',
        'tim_ut_by',
        'log_actual_id',
        'progress_bobot'
    ];

    public function project()
    {
        return $this->hasOne(MstProject::class, 'id', 'project_id');
        
    }

    public function listActivity()
    {
        return $this->hasOne(RefListActivity::class, 'id', 'activity_id');
        
    }

    public function supervisi()
    {
        return $this->hasOne(TranSupervisi::class, 'project_id', 'project_id');
        
    }

    public function waspangBy()
    {
        return $this->hasOne(MstWaspangUt::class, 'id', 'waspang_by');
        
    }

    public function tim_utBy()
    {
        return $this->hasOne(MstWaspangUt::class, 'id', 'tim_ut_by');
        
    }

    public function logActual()
    {
        return $this->hasOne(MstWaspangUt::class, 'id', 'log_actual_id');
        
    }
}
