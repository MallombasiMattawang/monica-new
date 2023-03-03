<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranSupervisi extends Model
{
    use HasFactory;

    protected $table = 'tran_supervisi';

    protected $fillable = [
        'project_id',
        'project_name',
        'task',
        'mitra_id',
        'witel_id',
        'waspang_id',
        'tim_ut_id',
        'edc',
        'toc',
        'material_bast_1',
        'jasa_bast_1',
        'total_bast_1',
        'total_akhir',
        'plan_homepass',
        'real_homepass',
        'status_const',
        'remarks',
        'progress_const',
        'tgl_selesai_ct',
        'tgl_selesai_ut',
        'tgl_rekon',
        'tgl_bast_1',
        'durasi_ct',
        'durasi_rekon',
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
        'status_doc',
        'posisi_doc',
        'progress_doc',
        'file_doc_witel',
        'file_doc_ped',
        'file_ba_rekon',
        'file_doc_bast',
        'progress_plan',
        'progress_actual',
        'plan_nilai',
        'real_nilai',
        'plan_port',
        'real_port',
        
        
    ];

    public function supervisi_sap()
    {
        return $this->hasOne(MstSap::class, 'name', 'project_name');
        
    }

    public function supervisi_project()
    {
        return $this->hasOne(MstProject::class, 'id', 'project_id');
        
    }

    public function supervisi_witel()
    {
        return $this->hasOne(MstWitel::class, 'id', 'witel_id');
        
    }

    public function supervisi_mitra()
    {
        return $this->hasOne(MstMitra::class, 'id', 'mitra_id');
        
    }

    public function supervisi_waspang()
    {
        return $this->hasOne(User::class, 'id', 'waspang_id');
        
    }

    public function supervisi_tim_ut()
    {
        return $this->hasOne(User::class, 'id', 'tim_ut_id');
        
    }

    public function namaOdp()
    {
        return $this->hasMany(TranOdp::class,'supervisi_id');
    }
}
