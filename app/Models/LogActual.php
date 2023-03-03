<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActual extends Model
{
    use HasFactory;
    protected $table = 'log_actual';

    protected $fillable = [
        'project_id',
        'tran_baseline_id',
        'activity_id',
        'actual_volume',
        'actual_progress',
        'actual_status',
        'actual_evident',
        'actual_message',
        'approval_waspang',
        'approval_tim_ut',
        'approval_message',
        'actual_start',
        'actual_finish',
        'actual_durasi',
        'supervisi_status',
        'waspang_by',
        'tim_ut_by',
        'progress_bobot'
    ];

    public function project()
    {
        return $this->hasOne(MstProject::class, 'id', 'project_id');
        
    }

    public function tran_baseline()
    {
        return $this->hasOne(TranBaseline::class, 'id', 'tran_baseline_id');
        
    }

    public function tran_supervisi()
    {
        return $this->hasOne(TranSupervisi::class, 'id', 'project_id');
        
    }

    public function waspangBy()
    {
        return $this->hasOne(MstWaspangUt::class, 'id', 'waspang_by');
        
    }

    public function tim_utBy()
    {
        return $this->hasOne(MstWaspangUt::class, 'id', 'tim_ut_by');
        
    }

   
}
