<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranInventory extends Model
{
    use HasFactory;

    protected $table = 'tran_inventory';
    protected $fillable = [
        'project_id',
        'project_name',
        
        'status_gl_sdi',
        'ket_gl_sdi',
        'status_abd',
        'id_sw',
        'id_imon',
        'odp_8',
        'odp_16',
        'ps_1_8',
        'ps_1_16',
        'odp_port',
        'nama_odp',
        'plan_golive',
        'real_golive',
        
    ];
}
