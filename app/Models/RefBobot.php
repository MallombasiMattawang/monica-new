<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefBobot extends Model
{
    use HasFactory;

    protected $table = 'ref_bobot';

    protected $fillable = [
        'name', 'bobot',
    ];

   
    public function listActivity()
    {
        return $this->belongsTo(RefListActivity::class, 'category_id', 'id');
    }

}
