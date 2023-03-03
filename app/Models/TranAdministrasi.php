<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranAdministrasi extends Model
{
    use HasFactory;

    protected $table = 'tran_administrasi';

    protected $fillable = [
        'project_id',
        'status_doc',
        'posisi_doc',
        'progress_doc',
        'file_doc',
        'status',
        'message'
       
    ];

    public function project()
    {
        return $this->hasOne(MstProject::class, 'id', 'project_id');
        
    }
}
