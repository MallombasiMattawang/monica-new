<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstSmilleyVolume extends Model
{
    use HasFactory;

    protected $table = 'mst_smilley_volume';

    protected $fillable = [
        'kd_kontrak',
        'no_amdke',
        'kd_wbs',
        'kd_sgrup',
        'pk_owner',
        'kd_lokasi1',
        'ubis_waslak',
        'unit_waslak',
        'waslak_har',
        'ubis_owner',
        'no_kontrak',  
        'nm_singkat',
        'tg_edc',  
        'tg_toc',
        'nm_tematik',
        'nm_witel',
        'nm_lokasi1',
        'project_site_id',
        'kt_lokasi',
        'site_alamat',
        'pro_plan',
        'pro_actual',
        'pro_bast',
        'status',
        'tg_plan_start',
        'tg_plan_finish',
        'tg_actual_start',
        'no_ut',
        'tg_ut',
        'no_bast1',
        'tg_baut',
        'nm_inf',
        'ni_kap_real',
        'ni_kap_sls',
        'satuan',
        'kt_volume',
        'nm_vendor',
        'tg_bast1'
    ];
}
