<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPlan extends Model
{
    use HasFactory;

    protected $table = 'log_plan';

    protected $fillable = [
        'project_id',
        'baseline_id',
        'log_date',
        'log_bobot',
        
    ];
}
