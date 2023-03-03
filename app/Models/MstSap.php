<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstSap extends Model
{
    use HasFactory;

    protected $table = 'mst_sap';

    protected $fillable = [
        'baru_co',
        'cfu',
        'flag',
        'uraian_wbs',
        'comm_release',
        'pay_release',
        'wbs_element',
        'purchasing_doc',
        'kontrak',
        'proses',
        'ref_doc_no',
        'item',
        'cost_elem',
        'name',
        'ses_pelimpahan',
        'witel',
        'id_vendor',
        'vendor',
        'ta_non_ta',
        'user',
        'doc_date',
        'nilai_pr_po_gr',
        'value_tcur',
        'status_pr',
        'status_po',
        'status_gr',
        'debit_date',
        'keterangan',
        'achv_progi',
        'tematik',
        'status_sap'
    ];

    public function project()
    {
        return $this->hasOne(MstProject::class, 'lop_site_id', 'name');
        //return $this->hasOne(ProgresDocument::class, 'id', 'progres_document_id');
    }
}
