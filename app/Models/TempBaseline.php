<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempBaseline extends Model
{
    use HasFactory;
    protected $table = 'temp_baseline';

    protected $fillable = [
        'project_id', 'actvity_id', 'category_id', 'list_activity', 'satuan'
    ];

}
