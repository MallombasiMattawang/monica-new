<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class MstProject extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'mst_project';

    protected $fillable = [
        'tipe_project',
        'tematik',
        'nde_permintaan',
        'perihal_nde',
        'tgl_nde',
        'nilai_permintaan',
        'nde_pelimpahan',
        'nomor_kontrak',
        'status_sap',
        'witel_id',
        'sto_id',
        'lop_site_id',
        'feeder_ku_kap_12',
        'feeder_ku_kap_24',
        'feeder_ku_kap_48',
        'feeder_ku_kap_96',
        'feeder_kt_kap_24',
        'feeder_kt_kap_48',
        'feeder_kt_kap_96',
        'feeder_kt_kap_144',
        'feeder_kt_kap_288',
        'distribusi_ku_kap_24_scpt',
        'distribusi_ku_kap_12_scpt',
        'distribusi_ku_kap_8_scpt',
        'distribusi_kt_kap_24_scpt',
        'distribusi_kt_kap_12_scpt',
        'distribusi_kt_kap_8_scpt',
        'odp_odp_8',
        'odp_odp_16',
        'odp_spl_1_8',
        'odp_spl_1_16',
        'odp_port',
        'catuan_jenis',
        'catuan_nama',
        'odc_odc_48',
        'odc_odc_96',
        'odc_odc_144',
        'odc_odc_288',
        'odc_576',
        'odc_total',
        'panjang_feeder',
        'panjang_dist',
        'tiang_baru',
        'jarak_ke_sto',
        'jml_home_pass',
        'rab_material',
        'rab_survey',
        'rab_total',
        'nilai_capex_per_port',
        'mitra_id',
        'status_project',
        'start_date',
        'end_date'
    ];

    public function sap()
    {
        return $this->hasOne(MstSap::class, 'name', 'lop_site_id');
    }

    public function witel()
    {
        return $this->hasOne(MstWitel::class, 'kode_user', 'witel_id');
    }

    public function mitra()
    {
        return $this->hasOne(MstMitra::class, 'kode_mitra', 'mitra_id');
    }
}


