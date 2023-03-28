<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranAdministrasi extends Model
{
    use HasFactory;

    protected $table = 'tran_administrasi';

    protected $fillable = [
        'witel_id',
        'project_id',
        'mitra_id',
        'status_doc',
        'posisi_doc',
        'file_doc',
        'file_ba_rekon',
        'status_ba_rekon',
        'remarks',
        'catatan_verifikator',
        'status_verfy',

    ];

    public function project()
    {
        return $this->hasOne(MstProject::class, 'id', 'project_id');
    }


    public function witel()
    {
        return $this->hasOne(MstWitel::class, 'id', 'witel_id');
    }
    public function mitra()
    {
        return $this->hasOne(MstMitra::class, 'id', 'mitra_id');
    }
}
