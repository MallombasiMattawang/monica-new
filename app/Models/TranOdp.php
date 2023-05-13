<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranOdp extends Model
{
    use HasFactory;

    protected $table = 'tran_odp';

    protected $fillable = [
        'supervisi_id',
        'jenis_odp',
        'nama_odp',
        'status_go_live',
        'kendala',
        'id_sw',
        'status_abd'
    ];
}
