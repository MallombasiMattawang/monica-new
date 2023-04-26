<?php

use App\Models\Gtk;
use App\Models\User;
use App\Models\Siswa;
use App\Models\LogPlan;
use App\Models\Sekolah;
use App\Models\MstMitra;
use App\Models\MstSatker;
use App\Models\WebProfil;
use App\Models\TranBaseline;
use App\Models\TranSupervisi;
use App\Models\LampiranMateri;
use App\Models\RefJenisKontrak;
use App\Models\MonitoringBelajar;
use App\Models\RefJenisPengadaan;
use App\Models\RefMetodePengadaan;
use Illuminate\Support\Collection;
use App\Models\RefKualifikasiUsaha;
use Illuminate\Support\Facades\Redirect;


function getProgressActual($project_id, $start_date)
{
    $sum_bobot_real = TranBaseline::where('project_id', $project_id)
        ->whereBetween('actual_start', [$start_date, date('Y-m-d')])
        ->selectRaw('ROUND(SUM(bobot * (actual_progress/100 )), 1) as total')
        ->value('total');

    return ($sum_bobot_real != null) ? $sum_bobot_real : 0;
}

function getProgressPlan($project_id, $start_date)
{
    $sum_bobot_plan = LogPlan::where('project_id', $project_id)
        ->whereBetween('log_date', [$start_date, date('Y-m-d')])
        ->selectRaw('ROUND(SUM(log_bobot), 1) as total')
        ->value('total');

    return ($sum_bobot_plan != null) ? $sum_bobot_plan : 0;
}

function singkat_angka($n, $presisi = 1)
{
    if ($n < 900) {
        $format_angka = number_format($n, $presisi);
        $simbol = '';
    } else if ($n < 900000) {
        $format_angka = number_format($n, $presisi);
        $simbol = '';
    } else if ($n < 900000000) {
        $format_angka = number_format($n / 1000000, $presisi);
        $simbol = 'jt';
    } else if ($n < 900000000000) {
        $format_angka = number_format($n / 1000000000, $presisi);
        $simbol = 'M';
    } else {
        $format_angka = number_format($n / 1000000000000, $presisi);
        $simbol = 'T';
    }

    if ($presisi > 0) {
        $pisah = '.' . str_repeat('0', $presisi);
        $format_angka = str_replace($pisah, ' ', $format_angka);
    }

    return $format_angka . $simbol;
    //return $n;
}
function separator($output)
{
    $format_angka = number_format(floatval($output), 0, '.', '.');
    return $format_angka;
}


function pendingItemCT($project_id)
{
    $query = TranBaseline::where('project_id', $project_id)
        ->where('activity_id', 20)
        ->where('pending_item', 'YA')
        ->exists();
    return $query;
}

function pendingItemUT($project_id)
{
    $query = TranBaseline::where('project_id', $project_id)
        ->where('activity_id', 21)
        ->where('pending_item', 'YA')
        ->exists();
    return $query;
}

function cekWaspangAdmin($project_id)
{
    $query = TranSupervisi::where('project_id', $project_id)
        ->where('task', 'NEED APPROVED WASPANG')
        ->exists();
    return $query;
}
function cekUtAdmin($project_id)
{
    $query = TranSupervisi::where('project_id', $project_id)
        ->where('task', 'NEED APPROVED TIM UT')
        ->exists();
    return $query;
}

function getNotifWaspang($waspang_id)
{
    $query = TranSupervisi::select('id', 'project_name', 'updated_at')
        ->where('waspang_id', $waspang_id)
        ->where('task', 'NEED APPROVED WASPANG')
        ->limit('10')
        ->get();
    return $query;
}
function countNotifWaspang($waspang_id)
{
    $query = TranSupervisi::where('waspang_id', $waspang_id)
        ->where('task', 'NEED APPROVED WASPANG')
        ->count();
    return $query;
}


function getNotifUt($tim_ut_id)
{
    $query = TranSupervisi::select('id', 'project_name', 'updated_at')
        ->where('tim_ut_id', $tim_ut_id)
        ->where('task', 'NEED APPROVED TIM UT')
        ->limit('10')
        ->get();
    return $query;
}
function countNotifUt($tim_ut_id)
{
    $query = TranSupervisi::where('tim_ut_id', $tim_ut_id)
        ->where('task', 'NEED APPROVED TIM UT')
        ->count();
    return $query;
}
function cek_last_preparing($project_id)
{
    $query = TranBaseline::select('actual_finish')
        ->where('project_id', $project_id)
        ->whereNotNull('actual_finish')
        ->where('actual_finish', '<>', '')
        ->whereBetween('activity_id', [1, 2])->count();
    return $query;
}
function cek_all_delivery($project_id)
{
    $query = TranBaseline::select('actual_finish')
        ->where('project_id', $project_id)
        ->whereBetween('activity_id', [3, 9])->count();
    return $query;
}
function cek_all_delivery_finish($project_id)
{
    $query = TranBaseline::select('actual_finish')
        ->where('project_id', $project_id)
        ->whereNotNull('actual_finish')
        ->where('actual_finish', '<>', '')
        ->whereBetween('activity_id', [3, 9])->count();
    return $query;
}
function cek_all_installasi($project_id)
{
    $query = TranBaseline::select('actual_finish')
        ->where('project_id', $project_id)
        ->whereBetween('activity_id', [10, 19])->count();
    return $query;
}
function cek_all_installasi_finish($project_id)
{
    $query = TranBaseline::select('actual_finish')
        ->where('project_id', $project_id)
        ->whereNotNull('actual_finish')
        ->where('actual_finish', '<>', '')
        ->whereBetween('activity_id', [10, 19])->count();
    return $query;
}

function cek_commisioning_tes($project_id)
{
    $query = TranBaseline::select('actual_finish')
        ->where('project_id', $project_id)
        ->whereNotNull('actual_finish')
        ->where('actual_finish', '<>', '')
        ->where('activity_id', 20)->exists();
    return $query;
}
function cek_ut($project_id)
{
    $query = TranBaseline::select('actual_finish')
        ->where('project_id', $project_id)
        ->where('approval_tim_ut', 'APPROVED')
        ->whereNotNull('actual_finish')
        ->where('actual_finish', '<>', '')
        ->where('activity_id', 21)->exists();
    return $query;
}
function cek_rekon($project_id)
{
    $query = TranBaseline::select('actual_finish')
        ->where('project_id', $project_id)
        ->where('actual_task', 'APPROVED')
        ->whereNotNull('actual_finish')
        ->where('actual_finish', '<>', '')
        ->where('activity_id', 22)->exists();
    return $query;
}



function getTahun()
{
    return [
        '2022',
        '2023',
        '2024'
    ];
}

function getStatusDokumen()
{
    return [
        'DRAFT',
        'COMPLETE'
    ];
}

function getStatusVerifikasi()
{
    return [
        'IN PROGRESS',
        'APPROVED',
        'REJECTED'
    ];
}

function getStatusTayang()
{
    return [
        'SHOW',
        'NOT SHOWING'
    ];
}

if (!function_exists('tgl_indo')) {
    function tgl_indo($tgl)
    {
        if ($tgl == "0000-00-00") {
            return "-";
        } else {
            $tanggal    = substr($tgl, 8, 2);
            $bulan      = get_bulan(substr($tgl, 5, 2));
            $tahun      = substr($tgl, 0, 4);
            // var_dump($tgl);
            return $tanggal . ' ' . $bulan . ', ' . $tahun;
        }
    }
}

if (!function_exists('selisih_hari')) {
    function selisih_hari($tgl_1, $tgl_2)
    {
        $tgl1 = strtotime($tgl_1);
        $tgl2 = strtotime($tgl_2);

        $jarak = $tgl2 - $tgl1;

        $hari = $jarak / 60 / 60 / 24;

        return $hari + 1 . ' Hari';
    }
}

if (!function_exists('get_bulan')) {
    function get_bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "Jan";
                break;
            case 2:
                return "Feb";
                break;
            case 3:
                return "Mar";
                break;
            case 4:
                return "Apr";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agust";
                break;
            case 9:
                return "Sept";
                break;
            case 10:
                return "Okt";
                break;
            case 11:
                return "Nov";
                break;
            case 12:
                return "Des";
                break;
        }
    }
}

if (!function_exists('rupiah')) {
    function rupiah($angka, $kurs = '')
    {
        if ($angka === '') {
            $angka = 0;
        }

        if ($kurs) {
            return $kurs . ' ' . number_format($angka);
        } else {
            return 'Rp ' . number_format($angka, 0, ',', '.') . ',-';
        }
    }
}



function statusColor($status)
{
    if ($status == "aktif") {
        $color = "success";
    }

    if ($status == "nonaktif") {
        $color = "danger";
    }



    return $color;
}




function getAvatar($role, $id)
{
    $avaName = getUserId($role, $id);
    if (!empty($avaName->foto)) {
        $ava = $avaName->foto;
    } else {
        $ava = 'avatar.png';
    }

    //return asset('uploads/avatar/' . $ava . '');
    return asset('uploads/' . $ava . '');
}

function getUserId($role, $id)
{
    if ($role == 'mitra') {
        $user = MstMitra::select('mst_mitra.nama_mitra AS name', 'mst_mitra.*')
            ->where('id', $id)
            ->first();
    } else {
        // abort(500);
        $user = User::find($id);
    }

    return $user;
}

function getUser()
{
    $role = activeGuard();
    $id = auth($role)->user()->id;

    if ($role == 'mitra') {
        $user = MstMitra::select('mst_mitra.nama_mitra AS name', 'mst_mitra.*')
            ->where('id', $id)
            ->first();
    } else {
        $user = User::find($id);
    }

    return $user;
}


function penghasilan()
{
    return ['Kurang dari Rp. 500,000', 'Rp. 500,000 - Rp. 999,999', 'Rp. 1,000,000 - Rp. 1,999,999', 'Rp. 2,000,000 - Rp. 4,999,999', 'Rp. 5,000,000 - Rp. 20,000,000', 'Tidak Berpenghasilan'];
}

function pendidikan()
{
    return ['Tidak sekolah', 'Sp-1', 'Putus SD', 'Paket A', 'Paket B', 'Paket C', 'SD / sederajat', 'SMP / sederajat', 'SMA / sederajat', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'];
}

function transportasi()
{
    return ['Jalan kaki', 'Kendaraan pribadi', 'Angkutan umum/bus/pete-pete', 'Jemputan sekolah', 'Kereta api', 'Andong/bendi/sado/dokar/delman/becak', 'Mobil pribadi', 'Mobil/bus antar jemput', 'Ojek', 'Sepeda', 'Sepeda motor', 'Lainnya'];
}

function tempatTinggal()
{
    return ['Bersama orang tua', 'Wali', 'Kos', 'Asrama', 'Panti Asuhan', 'Pesantren', 'Lainnya'];
}

function pangkat()
{
    return ['I/a', 'I/b', 'I/c', 'I/d', 'II/a', 'II/b', 'II/c', 'II/d', 'III/a', 'III/b', 'III/c', 'III/d', 'IV/a', 'IV/b', 'IV/c', 'IV/d', 'IV/e'];
}

function statusPegawai()
{
    return ['PNS', 'PPPK', 'PNS Depag', 'CPNS', 'GTY/PTY', 'Guru Honor Sekolah', 'Honor Daerah TK.I Provinsi', 'Honor Daerah TK.II Kab/Kota', 'Tenaga Honor Sekolah', 'Guru Bantu Pusat', 'PNS Diperbantukan'];
}

function lembaga()
{
    return ['Pemerintah Pusat', 'Pemerintah Propinsi', 'Pemerintah Kab/Kota', 'Ketua Yayasan', 'Kepala Sekolah', 'Lainnya'];
}

function sumberGaji()
{
    return ['APBN', 'APBD Provinsi', 'APBD Kabupaten/Kota', 'Sekolah', 'Yayasan', 'Lembaga Donor'];
}

function sex()
{
    return [
        'L' => 'Laki-Laki',
        'P' => 'Perempuan',
    ];
}

function jkSelected($jk)
{
    if ($jk == 'L') {
        $i = 'Laki - Laki';
    } elseif ($jk == 'P') {
        $i = 'Perempuan';
    } else {
        $i = '-';
    }

    return $i;
}

function pekerjaan()
{
    return ['Tidak bekerja', 'Nelayan', 'Petani', 'Peternak', 'PNS/TNI/Polri', 'Karyawan swasta', 'Pedagang kecil', 'Pedagang besar', 'Wiraswasta', 'Wirausaha', 'Buruh', 'Tenaga Kerja Indonesia', 'Pensiunan', 'Tidak dapat diterapkan', 'Sudah meninggal', 'Lainnya'];
}

function statusKawin()
{
    return ['Kawin', 'Belum Kawin', 'Janda/Duda'];
}

function wn()
{
    return [
        'ID' => 'WNI',
        'WNA' => 'WNA',
    ];
}


function agamaLists()
{
    return ['Islam', 'Katholik', 'Kristen Protestan', 'Hindu', 'Budha', 'Khong Hu Chu', 'Kepercayaan Kepada Tuhan YME'];
}

function kecamatan()
{
    return ['Kec. Allu', 'Kec. Anreapi', 'Kec. Binuang', 'Kec. Balanipa', 'Kec. Bulo', 'Kec. Campalagian', 'Kec. Limboro', 'Kec. Luyo', 'Kec. Mapilih', 'Kec. Matakali', 'Kec. Matangga', 'Kec. Polewali', 'Kec. Tapango', 'Kec. Tinambung', 'Kec. Tutar', 'Kec. Wonomulyo'];
}

//tambah helpers by awan kecamatan untuk selectbox
function kecamatanList()
{
    return ['Alu', 'Anreapi', 'Binuang', 'Balanipa', 'Bulo', 'Campalagian', 'Limboro', 'Luyo', 'Mapili', 'Matakali', 'Matangga', 'Polewali', 'Tapango', 'Tinambung', 'Tutar', 'Wonomulyo'];
}


function middlewareCheck($roles)
{
    $list = new Collection($roles);
    $roleActive = activeGuard();
    if (!$list->contains($roleActive)) {
        return abort(403, 'Oops, you cant access this page. more information contact admin. Thanks :) ');
    }
}

function activeGuard()
{
    foreach (array_keys(config('auth.guards')) as $guard) {
        if (
            auth()
            ->guard($guard)
            ->check()
        ) {
            return $guard;
        }
    }
    return null;
}



function upload($destination, $fileUpload, $fileName)
{
    // return $fileUpload->storeAs($destination, $fileName);
    return $fileUpload->move($destination, $fileName);
}
