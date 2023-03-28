<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAdministrasi extends Model
{
    use HasFactory;
    protected $table = 'log_administrasi';

    protected $fillable = [
        'tran_administrasi_id', 'status_doc', 'posisi_doc', 'file_doc', 'remarks', 'status_verfy', 'catatan_verifikator'
    ];
}
