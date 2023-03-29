<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewSupervisi extends Model
{
    use HasFactory;
    protected $table = 'supervisi_view';

    protected $fillable = [
        'id',
        'project_id',
        'tematik',
        'witel',
        'sto',
        'project_name',
        'mitra',
        'no_sp_telkom',
        'edc',
        'toc',
        'nilai_kontrak',
        'nilai_bast1_sap',
        'nilai_bast1_smilley',
        'plan_port',
        'real_port',
        'plan_homepass',
        'real_homepass',
        'name_waspang',
        'name_tim_ut',
        'status_const_app',
        'status_const_sap',
        'remarks',
        'kendala',


    ];
}
