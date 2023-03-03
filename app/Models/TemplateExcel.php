<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateExcel extends Model
{
    use HasFactory;

    protected $table = 'template_excel';

    protected $fillable = [
        'name', 'file_excel'
    ];
}
