<?php

namespace App\Imports;

use App\Models\MstProject;
use App\Models\MstSap;
use App\Models\TranSupervisi;
use App\Models\MstSmilleyNilai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class SmilleyNilaiImport implements OnEachRow, WithStartRow, WithCalculatedFormulas, WithValidation, SkipsEmptyRows, WithMultipleSheets

{
    public function onRow(Row $row)
    {

        // MstProject::where("lop_site_id", $row[14])
        //     ->update([
        //         'status_project' => $row[31]
        //     ]);


        $rowIndex = $row->getIndex();
        $row      = $row->toArray();
        $tgl_bast = null;
        $tg_plan_start = null;
        $tg_plan_finish = null;
        $tg_actual_start = null;
        $tg_edc = null;
        $tg_toc = null;
        $tg_ut = null;
        $tg_baut = null;

        if ($row[12] != null && gettype($row[12]) == 'integer') {
            $tg_edc = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12])->format('Y-m-d');
        }
        if ($row[13] != null && gettype($row[13]) == 'integer') {
            $tg_toc = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13])->format('Y-m-d');
        }
        if ($row[24] != null  && gettype($row[24]) == 'integer') {
            $tg_plan_start = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[24])->format('Y-m-d');
        }
        if ($row[25] != null && gettype($row[25]) == 'integer') {
            $tg_plan_finish = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[25])->format('Y-m-d');
        }
        if ($row[26] != null && gettype($row[26]) == 'integer') {
            $tg_actual_start = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[26])->format('Y-m-d');
        }
        if ($row[28] != null && gettype($row[28]) == 'integer') {
            $tg_ut = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[26])->format('Y-m-d');
        }
        if ($row[30] != null && gettype($row[30]) == 'integer') {
            $tg_baut = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[26])->format('Y-m-d');
        }

        if ($row[41] != null  && gettype($row[41]) == 'integer') {
            $tgl_bast = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[41])->format('Y-m-d');
        }

        TranSupervisi::where("project_name", $row[18])
            ->update([
                'edc' => $tg_edc,
                'toc' => $tg_toc,
            ]);

        MstSmilleyNilai::updateOrCreate(
            [
                'kt_lokasi' => $row[18],
            ],
            [
                'kd_kontrak' => $row[0],
                'no_amdke' => $row[1],
                'kd_wbs' => $row[2],
                'kd_sgrup' => $row[3],
                'pk_owner' => $row[4],
                'kd_lokasi1' => $row[5],
                'ubis_waslak' => $row[6],
                'unit_waslak' => $row[7],
                'waslak_har' => $row[8],
                'ubis_owner' => $row[9],
                'no_kontrak' => $row[10],
                'nm_proyek' => $row[11],
                'tg_edc' => $tg_edc,
                'tg_toc' => $tg_toc,
                'nm_tematik' => $row[14],
                'nm_witel' => $row[15],
                'nm_lokasi1' => $row[16],
                'project_site_id' => $row[17],
                'kt_lokasi' => $row[18],
                'site_alamat' => $row[19],
                'pro_plan' => $row[20],
                'pro_actual' => $row[21],
                'pro_bast' => $row[22],
                'status' => $row[23],
                'tg_plan_start' => $tg_plan_start,
                'tg_plan_finish' => $tg_plan_finish,
                'tg_actual_start' => $tg_actual_start,
                'no_ut' => $row[27],
                'tg_ut' => $tg_ut,
                'no_bast1' => $row[29],
                'tg_baut' => $tg_baut,
                'ni_barang' => $row[31],
                'ni_jasa' => $row[32],
                'ni_kontrak' => $row[33],
                'ni_bast1' => $row[34],
                'no_po1' => $row[35],
                'no_po2' => $row[36],
                'no_po3' => $row[37],
                'no_po4' => $row[38],
                'no_po5' => $row[39],
                'nm_vendor' => $row[40],
                "tg_bast1" => $tgl_bast,
                //'tg_bast1' => $row[41],
            ]

        );
    }

    public function startRow(): int
    {
        return 2;
    }

    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

    public function rules(): array
    {
        return [
            //'name' => 'required',
            '18' => 'required'
            // so on
        ];
    }
}
