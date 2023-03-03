<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefListActivity extends Model
{
    use HasFactory;

    protected $table = 'ref_activity';

    protected $fillable = [
        'code', 'status', 'list_activity', 'category_id', 'bobot_default', 'volume_default', 'satuan'
    ];

    public function bobot()
    {
        return $this->hasMany(RefBobot::class, 'id', 'category_id');
    }
}
