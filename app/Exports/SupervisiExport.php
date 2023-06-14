<?php

namespace App\Exports;

use App\Models\User;
use App\Models\LogActual;
use App\Models\TranBaseline;
use App\Models\ViewSupervisi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Cell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SupervisiExport implements FromQuery, WithHeadings, WithMapping, WithEvents
{
    public function query()
    {


        return ViewSupervisi::query();
    }

    public function create()
    {

    }

    public function map($row): array
    {
        // cek data sap
        //  $cek_email = User::select(DB::raw("CONCAT(first_name, ' ', last_name) AS full_name"))->where('name', $row->name_waspang)->value('email');
        // Mendapatkan data transaksi dari model
        $remarks = LogActual::where('project_id', $row->project_id)
            ->whereNotNull('actual_message')
            ->where('actual_message', '<>', '')->get();

        // Mengelompokkan transaksi berdasarkan tanggal
        $groupedRemarks = $remarks->groupBy(function ($remark) {
            return $remark->created_at->format('Y-m-d');
        });
        $row_remark = (!$remarks->last()) ?: sprintf("%s | ", $remarks->last()->actual_message);
        foreach ($groupedRemarks as $date => $remarks) {
            $row_remark .= tgl_indo($date) . ": \n";

            foreach ($remarks as $remark) {
                $row_remark .= "-" . $remark->actual_message . "\n";
            }
        }
        $row_remark .= "\n";

        $kendala = LogActual::where('project_id', $row->project_id)
            ->whereNotNull('actual_kendala')
            ->where('actual_kendala', '<>', '')->get();

        // Mengelompokkan transaksi berdasarkan tanggal
        $groupedKendala = $kendala->groupBy(function ($kendala) {
            return $kendala->created_at->format('Y-m-d');
        });
        $row_kendala = (!$kendala->last()) ?: sprintf("%s | ", $kendala->last()->actual_kendala);
        foreach ($groupedKendala as $date => $kendalas) {
            $row_kendala .= tgl_indo($date) . ": \n";

            foreach ($kendalas as $kendala) {
                $row_kendala .= "-" . $kendala->actual_kendala . "\n";
            }
        }

        $tgl_mos = TranBaseline::where('project_id', $row->project_id)
            ->whereNotNull('actual_finish')
            ->where('actual_finish', '<>', '')
            ->whereBetween('activity_id', [3, 9])
            ->orderBy('actual_finish', 'desc')
            ->first();
        $tgl_install_done = TranBaseline::where('project_id', $row->project_id)
            ->whereNotNull('actual_finish')
            ->where('actual_finish', '<>', '')
            ->whereBetween('activity_id', [10, 19])
            ->orderBy('actual_finish', 'desc')
            ->first();
        $tgl_selesai_ct = TranBaseline::where('project_id', $row->project_id)
            ->whereNotNull('actual_finish')
            ->where('actual_finish', '<>', '')
            ->where('activity_id', 20)
            ->first();
        $tgl_selesai_ut = TranBaseline::where('project_id', $row->project_id)
            ->whereNotNull('actual_finish')
            ->where('actual_finish', '<>', '')
            ->where('activity_id', 21)
            ->first();
        $tgl_selesai_rekon = TranBaseline::where('project_id', $row->project_id)
            ->whereNotNull('actual_finish')
            ->where('actual_finish', '<>', '')
            ->where('activity_id', 22)
            ->first();
        $tgl_bast1 = TranBaseline::where('project_id', $row->project_id)
            ->whereNotNull('actual_finish')
            ->where('actual_finish', '<>', '')
            ->where('activity_id', 23)
            ->first();
        if ($row->status_const_app == 'PREPARING' || $row->status_const_app == 'MATERIAL DELIVERY') {
            $progess_fisik = 'PREPARE';
        } elseif ($row->status_const_app == 'INSTALASI') {
            $progess_fisik = 'INSTALASI';
        } elseif ($row->status_const_app == 'INSTALL DONE' || $row->status_const_app == 'SELESAI CT' || $row->status_const_app == 'SELESAI UT' || $row->status_const_app == 'INSTALL DONE' || $row->status_const_app == 'BAST-1') {
            $progess_fisik = 'FISIK DONE';
        } else {
            $progess_fisik = '-';
        }
        if ($row->status_golive == 'GOLIVE') {
            $golive = 'GOLIVE';
        } else {
            $golive = 'NY';
        }
        return [
            $row->id,
            $row->tematik,
            $row->witel,
            $row->sto,
            $row->project_name,
            $row->mitra,
            $row->no_sp_telkom,
            $row->edc,
            $row->toc,
            $row->nilai_kontrak,
            $row->nilai_bast1_sap,
            $row->nilai_bast1_smilley,
            $row->plan_port,
            $row->real_port,
            $row->plan_homepass,
            $row->real_homepass,
            $row->name_waspang,
            $row->name_tim_ut,
            $row->status_const_app,
            $row->status_const_sap,
            $row_remark,
            $row_kendala,
            isset($tgl_mos->actual_finish) && cek_all_delivery($row->project_id) == cek_all_delivery_finish($row->project_id) ? $tgl_mos->actual_finish : '-',
            isset($tgl_install_done->actual_finish) && cek_all_installasi($row->project_id) == cek_all_installasi_finish($row->project_id) ? $tgl_install_done->actual_finish : '-',
            isset($tgl_selesai_ct->actual_finish) ? $tgl_selesai_ct->actual_finish : '-',
            isset($tgl_selesai_ut->actual_finish) ? $tgl_selesai_ut->actual_finish : '-',
            isset($tgl_selesai_rekon->actual_finish) ? $tgl_selesai_rekon->actual_finish : '-',
            isset($tgl_bast1->actual_finish) ? $tgl_bast1->actual_finish : '-',
            isset($tgl_install_done->actual_finish) && cek_all_installasi($row->project_id) == cek_all_installasi_finish($row->project_id)  ? selisih_hari($tgl_mos->actual_finish, $tgl_install_done->actual_finish) : '-',
            isset($tgl_selesai_ct->actual_finish) ? selisih_hari($tgl_install_done->actual_finish, $tgl_selesai_ct->actual_finish) : '-',
            isset($tgl_selesai_ut->actual_finish) ? selisih_hari($tgl_selesai_ct->actual_finish, $tgl_selesai_ut->actual_finish) : '-',
            isset($tgl_selesai_rekon->actual_finish) ? selisih_hari($tgl_selesai_ut->actual_finish, $tgl_selesai_rekon->actual_finish) : '-',
            $row->flaging_mitra,
            $progess_fisik,
            $golive


        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'TEMATIK',
            'WITEL',
            'STO',
            'PROJECT_NAME',
            'MITRA',
            'NO SP TELKOM',
            'edc',
            'toc',
            'nilai kontrak',
            'nilai bast1 sap',
            'nilai bast1 smilley',
            'plan port',
            'real port',
            'plan homepass',
            'real homepass',
            'name waspang',
            'name tim ut',
            'status const app',
            'status const sap',
            'remarks',
            'kendala',
            'tgl MOS',
            'tgl Install Done',
            'tgl Selesai CT',
            'tgl Selesai UT',
            'tgl Selesai Rekon',
            'tgl BAST1',
            'Durasi Install',
            'Durasi CT',
            'Durasi UT',
            'Durasi Closing',
            'Flaging Mitra',
            'Progres Fisik',
            'Status GOLIVE',

        ];
    }

    // Implement WithHeadings


    // Implement WithStyles
    public function styles(Worksheet $sheet): void
    {
        $sheet->getStyle('A1:AI1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF0000FF');
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => [self::class, 'afterSheet']
        ];
    }

    /**
     * @throws Exception
     */
    public static function afterSheet(AfterSheet $sheet): void
    {
        $column = $sheet->getDelegate()->getHighestRow();

        $sheet->sheet->autoSize();
        for ($i = 2; $i <= $column; $i++) {
            if (strpos($sheet->getDelegate()->getCell(sprintf("U%s", $i))->getValue(), "\n") > 0) {
                $value = $sheet->getDelegate()->getCell(sprintf("U%s", $i))->getValue();

                $array = explode(" | ", $value);
                $sheet->getDelegate()->getCell(sprintf("U%s", $i))->setValue(reset($array));


                $sheet->sheet
                    ->getDelegate()
                    ->getComment(sprintf("U%s", $i))
                    ->setHeight("650px")
                    ->setWidth("450px")
                    ->getText()
                    ->createTextRun(end($array));
            } else {
                $sheet->getDelegate()->getCell(sprintf("U%s", $i))->setValue("");

            }

            if (strpos($sheet->getDelegate()->getCell(sprintf("V%s", $i))->getValue(), "\n") > 0) {
                $value = $sheet->getDelegate()->getCell(sprintf("V%s", $i))->getValue();

                $array = explode(" | ", $value);
                $sheet->getDelegate()->getCell(sprintf("V%s", $i))->setValue(reset($array));


                $sheet->sheet
                    ->getDelegate()
                    ->getComment(sprintf("V%s", $i))
                    ->setHeight("650px")
                    ->setWidth("450px")
                    ->getText()
                    ->createTextRun(end($array));
            } else {
                $sheet->getDelegate()->getCell(sprintf("V%s", $i))->setValue("");

            }
        }
    }
}

