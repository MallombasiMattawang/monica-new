@extends('pengguna.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('cssbundle/summernote.min.css') }}" />
    <style>
        /* #map-search { position: absolute; top: 10px; left: 10px; right: 10px; }
              #search-txt { float: left; width: 60%; } */
        #search-btn {
            float: left;
            width: 19%;
        }

        #detect-btn {
            float: right;
            width: 19%;
        }

        /* #map-canvas { position: absolute; top: 40px; bottom: 65px; left: 10px; right: 10px; }
              #map-output { position: absolute; bottom: 10px; left: 10px; right: 10px; }
              #map-output a { float: right; } */
    </style>
@endpush


@section('page_header')
    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-2">
                    @include('pengguna.layouts.partials.breadcrumb')
                    <div class="d-flex">
                        <h1 class="h2 mb-2 text-white  ptx-5">{{ $pageTitle }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('contents')
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body border-bottom">
                            @if ($message = Session::get('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <div class="d-flex">
                                        <i class='bx fs-5 bxs-check-circle'></i>
                                        {{ $message }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-10">
                                    <div class="d-flex align-items-md-start align-items-center flex-column flex-md-row">
                                        <div class="media-body m-0 mt-4 mt-md-0 text-md-start text-center">
                                            <h4 class="mb-1 fw-bold ">
                                                {{ $profil->nama_paket }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">

                                    <a class="btn btn-primary w-100 dropdown-toggle" href="#" role="button"
                                        id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        Kelola Paket
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#modalLampiran"><i class="fa fa-file"></i> Add Lampiran </a>
                                        </li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#modalKoordinat"><i class="fa fa-map-marker"></i> Add
                                                Koordinat </a>
                                        </li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#modalKirim"><i class="fa fa-paper-plane-o"></i> Kirim ke
                                                Direktorat
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#modalTayang"><i class="fa fa-eye"></i> Tayangkan Paket
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#modalPemenang"><i class="fa fa-user"></i> Pemenang
                                                Paket
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-pencil"></i> Edit </a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Hapus </a>
                                        </li>
                                    </ul>


                                </div>
                            </div>
                        </div>



                        <ul class="nav nav-tabs tab-card border-bottom-0 pt-2 fs-6 justify-content-center justify-content-md-start"
                            role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#profile" role="tab">
                                    <i class="fa fa-dropbox"></i>
                                    <span>Data Paket</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#klasifikasi" role="tab">
                                    <i class="fa fa-users"></i>
                                    <span class="d-none d-sm-inline-block ms-2">Klasifikasi</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#lampiran" role="tab">
                                    <i class="fa fa-files-o"></i>
                                    <span class="d-none d-sm-inline-block ms-2">Lampiran</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#koordinat" role="tab">
                                    <i class="fa fa-map-marker"></i>
                                    <span class="d-none d-sm-inline-block ms-2">Koordinat</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#pemenang" role="tab">
                                    <i class="fa fa-address-card-o"></i>
                                    <span class="d-none d-sm-inline-block ms-2">Pemenang Paket</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#kurvaS" role="tab">
                                    <i class="fa fa-edit"></i>
                                    <span class="d-none d-sm-inline-block ms-2">Kurva S</span>
                                </a>
                            </li>

                        </ul>
                    </div>


                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5>Rincian Paket</h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="table-responsive">
                                                                <table class="table-sm table  table-hover ">
                                                                    <tr>
                                                                        <td class="text-muted">Kode RUP </td>
                                                                        <td> {{ $profil->kode_rup }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted">K/L/PD </td>
                                                                        <td> {{ $profil->klpd->nama_klpd }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted">Nama Satker</td>
                                                                        <td> {{ $profil->satker->nama_satuan_kerja }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted">Jenis Pengadaan</td>
                                                                        <td> {{ $profil->jenisPengadaan->jenis_pengadaan }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="30%" class="text-muted">Kode RUP
                                                                        </td>
                                                                        <td> {{ $profil->kode_rup }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted">Nama Paket</td>
                                                                        <td> {{ $profil->nama_paket }} </td>
                                                                    </tr>

                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">

                                                            <div class="table-responsive">
                                                                <table class="table-sm table  table-hover ">
                                                                    <tr>
                                                                        <td class="text-muted">Sumber Dana</td>
                                                                        <td> {{ $profil->sumber_dana }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted">Tanggal Pembuatan</td>
                                                                        <td> {{ tgl_indo($profil->tgl_pembuatan) }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="35%" class="text-muted">Tahun
                                                                            Anggaran
                                                                        </td>
                                                                        <td> {{ $profil->tahun_anggaran }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted">Nilai HPS </td>
                                                                        <td> {{ rupiah($profil->nilai_hps_paket) }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted">Nilai Pagu</td>
                                                                        <td> {{ rupiah($profil->nilai_pagu_paket) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted">Lokasi Pekerjaan </td>
                                                                        <td> {{ $profil->lokasi_pekerjaan }} </td>
                                                                    </tr>
                                                                </table>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show " id="klasifikasi" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <h5>Klasifikasi</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="table-responsive">
                                                        <table class="table-sm table  table-hover ">
                                                            <tr>
                                                                <td width="30%" class="text-muted">Metode Pengadaan
                                                                </td>
                                                                <td> {{ $profil->metodePengadaan->metode_pengadaan }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Jenis Kontrak</td>
                                                                <td> {{ $profil->jenisKontrak->jenis_kontrak }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Kualifikasi Usaha</td>
                                                                <td> {{ $profil->kualifikasiUsaha->kualifikasi_usaha }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Syarat Kualifikasi </td>
                                                                <td> {{ $profil->syarat_kualifikasi }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Peserta Tender </td>
                                                                <td> {{ $profil->peserta_tender }} </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show " id="lampiran" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <h5>Lampiran</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="table-responsive">
                                                        <table class="table-sm table  table-hover ">
                                                            <tr>
                                                                <td width="45%" class="text-muted">Lampiran Kualifikasi
                                                                </td>
                                                                <td> {!! $profil->lampiran_kualifikasi
                                                                    ? '<a href="' .
                                                                        $profil->lampiran_kualifikasi .
                                                                        '" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download</a>'
                                                                    : 'Belum ada lampiran' !!}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-muted">Dokumen Paket
                                                                </td>
                                                                <td> {!! $profil->dokumen_paket
                                                                    ? '<a href="' .
                                                                        $profil->dokumen_paket .
                                                                        '" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download</a>'
                                                                    : 'Belum ada lampiran' !!}
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show " id="koordinat" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <h5>Koordinat Paket</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="table-responsive">
                                                        <?php
                                                        $no = 0;
                                                        ?>
                                                        <table class="table-sm table  table-hover ">
                                                            <tr>
                                                                <thead>
                                                                    <th>No</th>
                                                                    <th>Lokasi Administratif</th>
                                                                    <th>Koordinat (Lat,Lng)</th>
                                                                    <th></th>
                                                                </thead>
                                                                <tbody>
                                                                    @forelse ($profil->paketKoordinat as $k)
                                                                        @php
                                                                            $no++;
                                                                        @endphp
                                                                        <tr>
                                                                            <td>{{ $no }}</td>
                                                                            <td>{{ $k->lokasi_administratif }}</td>
                                                                            <td>{{ $k->x }}, {{ $k->y }}
                                                                            </td>
                                                                            <td> <a href=""
                                                                                    class="btn btn-danger btn-sm"><i
                                                                                        class="fa fa-trash"></i> </a> </td>
                                                                        </tr>
                                                                    @empty
                                                                    @endforelse
                                                                </tbody>
                                                            </tr>

                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div id="map" style="width:100%; height:255px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show " id="dokumen" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <h5>Dokumen Arsip</h5>
                                            <div class="row">
                                                <div class="col-md-12">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show " id="sertifikasi" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-9">
                                                    <h5>Sertifikasi</h5>
                                                </div>
                                                <div class="col-3">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#statusSertifikasi"
                                                        class="btn rounded-pill w-100 btn-warning"> Edit Status
                                                        Sertifikasi</a>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table-sm table  table-hover ">
                                                            <tr>
                                                                <td width="20%" class="text-muted">Status
                                                                </td>
                                                                <td> {{ $profil->sertifikasi_status }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="20%" class="text-muted">Nomor Sertifikat
                                                                </td>
                                                                <td> {{ $profil->sertifikasi_nomor }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="20%" class="text-muted">Tanggal Sertifikasi
                                                                </td>
                                                                <td> {{ $profil->sertifikasi_tgl }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="20%" class="text-muted">Nomor Peserta </td>
                                                                <td> {{ $profil->sertifikasi_no_peserta }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="20%" class="text-muted">Instansi
                                                                    Pengangkatan </td>
                                                                <td> {{ $profil->sertifikasi_instansi }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="20%" class="text-muted">Bidang Studi </td>
                                                                <td> {{ $profil->sertifikasi_bidang }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="20%" class="text-muted">Dokumen </td>
                                                                <td>
                                                                    <a
                                                                        href="{{ asset('uploads/administrasi/' . $profil->sertifikasi_file . '') }}">Lihat
                                                                        Sertifikat</a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade show " id="presensi" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <h5>Laporan Presensi</h5>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <center>
                                                        <a href="#" class="btn btn-lg btn-primary"> Lihat Laporan
                                                            Presensi Disini. </a>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show " id="surat" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <h5>Administrasi</h5>
                                            <div class="row">
                                                <div class="col-md-12">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <!-- Modal Modal Centered Scrollable-->
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $profil->id }}">

        <div class="modal fade" id="modalKoordinat" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Koordinat Paket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-primary mb-3" role="alert">
                            Masukan Koordinat pelaksanaan paket
                        </div>
                        <div class="col-md-12">
                            <div id="map-search">
                                <input id="search-txt" class="form-control" type="text"
                                    value="Makassar, Kota Makassar, Sulawesi Selatan, Indonesia" maxlength="100">
                            </div>
                            <div id="map-canvas" style="width:100%; height:255px;"></div>

                            <button id="search-btn" class="btn btn-primary w-50" type="button">Locate Address</button>
                            <input id="detect-btn" class="btn btn-info w-50" type="button" value="Detect Location"
                                disabled>
                            <br><br>
                            <div class="mb-3">
                                <label for="lokasi_administrasi" class="form-label">Lokasi Administrasi</label>
                                <textarea name="" id="lokasi_administrasi" class="form-control" cols="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="x" class="form-label">Latitude</label>
                                <input name="x" id="xInput" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="y" class="form-label">Longitude</label>
                                <input name="x" id="yInput" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Koordinat</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $profil->id }}">

        <div class="modal fade" id="modalLampiran" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lampiran Paket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-primary mb-3" role="alert">
                            Tipe file lampiran PDF, ukuran maksimal 2Mb
                        </div>
                        <div class="mb-3">
                            <label for="file_kualifikasi" class="form-label">Lampiran Kualifikasi</label>
                            <input class="form-control" type="file" id="file_kualifikasi">
                        </div>
                        <div class="mb-3">
                            <label for="file_dokumen" class="form-label">Dokumen Paket</label>
                            <input class="form-control" type="file" id="file_dokumen">
                        </div>
                        <div class="mb-3">
                            <label for="syarat_klasifikasi" class="form-label">Syarat Klasifikasi</label>
                            <textarea id="summernote" name="syarat_klasifikasi" id="syarat_klasifikasi" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Lampiran</button>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $profil->id }}">
        <div class="modal fade" id="modalPemenang" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pemenang/Pelaksana Paket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-primary mb-3" role="alert">
                            Mohon cari terlebih dahulu di data vendor, jika tidak ditemukan silahkan buat data dan akun
                            Vendor pemenang
                        </div>
                        <ul class="nav nav-tabs tab-page-toolbar rounded d-inline-flex w-100" role="tablist">
                            <li class="nav-item w-50 text-center"><a class="nav-link active" data-bs-toggle="tab"
                                    href="#nav-vendor" role="tab">Cari Vendor</a></li>
                            <li class="nav-item w-50 text-center"><a class="nav-link" data-bs-toggle="tab"
                                    href="#nav-new-vendor" role="tab">Buat Vendor</a></li>
                        </ul>

                        <div class="tab-content mt-2">
                            <div class="tab-pane fade show active" id="nav-vendor" role="tabpanel">
                                <div class="form-group mb-3">
                                    <select name="sertifikasi_status" class="form-control" id="">
                                        <option value="">Cari Vendor...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-new-vendor" role="tabpanel">
                                <div class="mb-3">
                                    <label for="npwp" class="form-label">NPWP Pemenang</label>
                                    <input class="form-control" type="text" name="npwp">
                                </div>
                                <div class="mb-3">
                                    <label for="nama_vendor" class="form-label">Nama Pemenang</label>
                                    <input class="form-control" type="text" name="nama_vendor">
                                </div>
                                <div class="mb-3">
                                    <label for="alamat_vendor" class="form-label">Alamat</label>
                                    <input class="form-control" type="text" name="alamat_vendor">
                                </div>
                                <div class="mb-3">
                                    <label for="telp_vendor" class="form-label">Telp</label>
                                    <input class="form-control" type="text" name="telp_vendor">
                                </div>
                                <div class="mb-3">
                                    <label for="email_vendor" class="form-label">Email </label>
                                    <input class="form-control" type="email" name="email_vendor">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control" type="password" name="password">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @push('scripts')
        {{-- <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script> --}}
        <script src="{{ asset('js/mapInput.js') }}"></script>
        <script type="text/javascript">
            function initMap() {
                const myLatLng = { lat: 22.2734719, lng: 70.7512559 };
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 5,
                    center: myLatLng,
                });
      
                var locations = {{ Js::from($locations) }};
      
                var infowindow = new google.maps.InfoWindow();
      
                var marker, i;
                  
                for (i = 0; i < locations.length; i++) {  
                      marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map
                      });
                        
                      google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                          infowindow.setContent(locations[i][0]);
                          infowindow.open(map, marker);
                        }
                      })(marker, i));
      
                }
            }
      
            window.initMap = initMap;
        </script>
        {{-- <script
            src="//maps.googleapis.com/maps/api/js?v=3&amp;key={{ env('GOOGLE_MAPS_API_KEY') }}&amp;callback=initAutocomplete"
            defer></script> --}}
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&signed_in=true&libraries=places&callback=initialize"
            async defer></script>
        <script>
            function initialize() {
                loadmap();
                initMap();
            }
        </script>





        <script src="{{ asset('js/bundle/summernote.bundle.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#summernote').summernote();
                $('.note-editor .note-btn').on('click', function() {
                    $(this).next().toggleClass("show");
                });
            });
        </script>
    @endpush
@endsection
