<?php

namespace App\Http\Controllers\Paket;


use App\Models\TranPaket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class SatkerController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle  = "Daftar Paket " . getUser()->name;
        $breadcrumb = [
            'Data Paket',
        ];
        return view(
            'pengguna.pages.paket.satker.index',
            compact('pageTitle', 'breadcrumb')
        );
    }

    public function detail($id = null, $slug = null)
    {
        $profil = TranPaket::find($id);
        $pageTitle  = "Rincian Paket";
        $breadcrumb = [
            'Data Paket',
            $profil->kode_rup
        ];
        $locations = [
            ['Mumbai', 19.0760,72.8777],
            ['Pune', 18.5204,73.8567],
            ['Bhopal ', 23.2599,77.4126],
            ['Agra', 27.1767,78.0081],
            ['Delhi', 28.7041,77.1025],
            ['Rajkot', 22.2734719,70.7512559],
        ];

        return view(
            'pengguna.pages.paket.satker.detail',
            compact('pageTitle', 'breadcrumb', 'profil', 'locations')
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_rup'  => 'required',
            'nama_paket'  => 'required',
            'sumber_dana' => 'required',
            'nilai_hps_paket' => 'required',
            'tgl_pembuatan' => 'required',
            'jenis_pengadaan_id' => 'required',
            'metode_pengadaan_id' => 'required',
            'tahun_anggaran' => 'required',
            'nilai_pagu_paket' => 'required',
            'jenis_kontrak_id' => 'required',
            'lokasi_pekerjaan' => 'required',
            'kualifikasi_usaha_id' => 'required',
            'peserta_tender' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        $data = [
            'kode_rup'  => $request->kode_rup,
            'nama_paket'  => $request->nama_paket,
            'sumber_dana' => $request->sumber_dana,
            'nilai_hps_paket' => $request->nilai_hps_paket,
            'tgl_pembuatan' => $request->tgl_pembuatan,
            'jenis_pengadaan_id' => $request->jenis_pengadaan_id,
            'metode_pengadaan_id' => $request->metode_pengadaan_id,
            'tahun_anggaran' => $request->tahun_anggaran,
            'nilai_pagu_paket' => $request->nilai_pagu_paket,
            'jenis_kontrak_id' => $request->jenis_kontrak_id,
            'lokasi_pekerjaan' => $request->lokasi_pekerjaan,
            'kualifikasi_usaha_id' => $request->kualifikasi_usaha_id,
            'peserta_tender' => $request->peserta_tender,
            'klpd_id'  => getUser()->klpd_id,
            'satker_id'  => getUser()->id,
        ];

        TranPaket::create($data);

        return response()->json(['success' => 'Paket berhasil dibuat.']);
    }

    public function jsonPaket()
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
        $satker_id =  getUser()->id;
        //$pakets = TranPaket::where('satker_id', getUser()->id)->with('jenisPengadaan')->get();
        $pakets = TranPaket::whereRaw("satker_id = $satker_id $where")
            ->with('jenisPengadaan')
            ->orderBy('id', 'ASC')
            ->get();
        return DataTables::of($pakets)
            ->addColumn('nama_paket', function ($paket) {
                $display = '<b>' . $paket->nama_paket . '</b>' . '<br><br> Nilai Kontrak : Rp. ' . $paket->nilai_hps_paket . '<br>Jenis Pengadaan : ' . $paket->jenisPengadaan->jenis_pengadaan . '<br>Tahun Anggaran : ' . $paket->tahun_anggaran . '<br>Sumber Dana :' . $paket->sumber_dana;
                return $display;
            })

            ->addColumn('status_verifikasi', function ($paket) {
                $display = '-';
                if ($paket->status_verifikasi) {
                    $display = $paket->status_verifikasi;
                }
                return $display;
            })
            ->addColumn('status_tayang', function ($paket) {
                $display = '-';
                if ($paket->status_tayang) {
                    $display = $paket->status_tayang;
                }
                return $display;
            })
            ->addColumn('action', function ($row) {
                return '
                <div class="dropdown morphing scale-left">
                            <a href="#" class="dropdown-toggle btn btn-primary btn-sm btn-block" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-edit"></i> Action</a>
                            <ul class="dropdown-menu shadow border-0 p-2">
                                <li><a class="dropdown-item" href="' . route('paket.satker.detail', [$row->id, Str::slug($row->nama_paket)]) . '">Detail</a></li>
                                <li><a class="dropdown-item" href="' . route('paket.satker.edit', [$row->id, Str::slug($row->nama_paket)]) . '">Edit</a></li>
                                <li><a class="dropdown-item text-danger" href="#" onclick="deleteData(' . $row->id . ')" >Hapus</a></li>
                            </ul>
                        </div>
                ';
            })
            ->rawColumns(['nama_paket', 'status_verifikasi', 'status_tayang', 'action'])


            ->make(TRUE);
    }
}
