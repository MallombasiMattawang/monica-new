<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class MstMitra extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $table = 'mst_mitra';
    protected $guard = "mitra";
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_mitra',
        'nama_mitra',
        'avatar',
        'singkatan',
        'alamat',
        'rt',
        'rw',
        'kode_pos',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'lat',
        'lon',
        'telepon',
        'fax',
        'website',
        'sosial_media',
        'remember_token',
        'mitra_active',
        'username',
        'password',
        'email',
    ];

    protected $hidden = [
        //     'password',
        'remember_token',
    ];

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }
}
