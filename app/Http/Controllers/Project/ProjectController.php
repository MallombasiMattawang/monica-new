<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\MstProject;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle  = "Daftar Project " . getUser()->name;
        $breadcrumb = [
            'Data Project',
        ];
        return view(
            'pengguna.pages.project.index',
            compact('pageTitle', 'breadcrumb')
        );
    }

    public function jsonProject()
    {
        $where = '';

        $keyword = request()->input('keyword');
        if (!empty($keyword)) {
            $where .= "AND nama_paket LIKE '%$keyword%' ";
        }

        $jenis_pengadaan = request()->input('jenis_pengadaan');
        if (!empty($jenis_pengadaan) && $jenis_pengadaan != "All") {
            $where .= "AND jenis_pengadaan_id = '$jenis_pengadaan' ";
        }

        $tahun = request()->input('tahun');
        if (!empty($tahun) && $tahun != "All") {
            $where .= "AND tahun_anggaran = '$tahun' ";
        }

        $status_dokumen = request()->input('status_dokumen');
        if (!empty($status_dokumen) && $status_dokumen != "All") {
            $where .= "AND status_dokumen = '$status_dokumen' ";
        }

        $status_verifikasi = request()->input('status_verifikasi');
        if (!empty($status_verifikasi) && $status_verifikasi != "All") {
            $where .= "AND status_verifikasi = '$status_verifikasi' ";
        }
        $mitra_id =  getUser()->username;
        $pakets = MstProject::whereRaw("mitra_id = '$mitra_id' $where")
            ->with('sap')
            ->orderBy('id', 'ASC')
            ->get();
        return DataTables::of($pakets)
            ->addColumn('lop_site_id', function ($paket) {
                //$display = '<b>' . $paket->nama_paket . '</b>' . '<br><br> Nilai Kontrak : Rp. ' . $paket->nilai_hps_paket . '<br>Jenis Pengadaan : ' . $paket->jenisPengadaan->jenis_pengadaan . '<br>Tahun Anggaran : ' . $paket->tahun_anggaran . '<br>Sumber Dana :' . $paket->sumber_dana;
                $display = '<b>' . $paket->lop_site_id . '</b>';
                return $display;
            })

            ->addColumn('status_project', function ($paket) {
                $display = '-';
                $color = '-';
                if ($paket->status_project == 'USULAN') {
                    $color = 'bg-warning';
                } else if ($paket->status_project == 'DROP') {
                    $color = 'bg-danger';
                } else {
                    $color = 'bg-success';
                }

                if ($paket->status_project) {
                    $display = '<span class="badge ' . $color . '">' . $paket->status_project . '</span>';
                }
                return $display;
            })

            ->addColumn('action', function ($row) {
                $display = '<a class="btn btn-primary" href="' . route('project.detail', [$row->id, Str::slug($row->lop_site_id)]) . '"><b>Detail</b>';
                return $display;
            })
            ->rawColumns(['lop_site_id', 'status_project', 'action'])


            ->make(TRUE);
    }
}
