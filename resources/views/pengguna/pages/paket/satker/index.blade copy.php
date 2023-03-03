@extends('pengguna.layouts.app')

@section('meta')
@endsection
@section('page_header')
    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class=" mb-2">
                    @include('pengguna.layouts.partials.breadcrumb')
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h2 mb-md-0 text-white fw-light">{{ $pageTitle }}</h1>
                        <div class="page-action">
                            <!-- btn:: create new project -->
                            <button class="btn d-sm-inline-flex rounded-pill" data-bs-toggle="modal"
                                data-bs-target="#create_project" type="button">
                                <span class="me-1 d-none d-lg-inline-block">Buat Paket &nbsp;</span>
                                <i class="fa fa-plus"></i>
                            </button>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('contents')
    <div class="page-body">
        <div class="">
            <div class="row justify-content-center">
                <div class="col-12 mb-2">
                    {{-- Filter --}}
                    <div class="p-3 bg-card  shadow  rounded-4 mb-4">
                        <form action="">
                            <input type="hidden" name="page" value="{{ request()->input('page') }}">
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <div class="form-floating">
                                        <select name="jenis_pengadaan" class="form-select" id="floatingSelect"
                                            aria-label="Floating label select example">
                                            <option value="All" selected>Semua</option>
                                            @foreach (getJenisPengadaan() as $d)
                                                <option value="{{ $d->id }}"
                                                    {{ $d->id == request()->input('jenis_pengadaan') ? 'selected' : '' }}>
                                                    {{ $d->jenis_pengadaan }} </option>
                                            @endforeach
                                        </select>
                                        <label for="floatingSelect">Jenis Pengadaan</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <div class="form-floating">
                                        <select name="tahun" class="form-select" id="floatingSelect">
                                            <option value="All" selected>Semua</option>
                                            @foreach (getTahun() as $d)
                                                <option value="{{ $d }}"
                                                    {{ $d == request()->input('tahun') ? 'selected' : '' }}>
                                                    {{ $d }} </option>
                                            @endforeach

                                        </select>
                                        <label for="floatingSelect">Tahun Anggaran</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <div class="form-floating">
                                        <select name="status_dokumen" class="form-select" id="floatingSelect">
                                            <option value="All" selected>Semua</option>
                                            @foreach (getStatusDokumen() as $d)
                                                <option value="{{ $d }}"
                                                    {{ $d == request()->input('status_dokumen') ? 'selected' : '' }}>
                                                    {{ $d }} </option>
                                            @endforeach
                                        </select>
                                        <label for="floatingSelect">Status Dokumen</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <div class="form-floating">
                                        <select name="status_verifikasi" class="form-select" id="floatingSelect">
                                            <option value="All" selected>Semua</option>
                                            @foreach (getStatusVerifikasi() as $d)
                                            <option value="{{ $d }}"
                                                {{ $d == request()->input('status_verifikasi') ? 'selected' : '' }}>
                                                {{ $d }} </option>
                                        @endforeach

                                        </select>
                                        <label for="floatingSelect">Status Verifikasi </label>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <div class="form-floating">
                                        <input type="text" name="keyword" class="form-control"
                                            value="{{ request()->input('keyword') }}" placeholder="Cari Paket"
                                            autocomplete="off">
                                        <label>Cari Paket</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-1 text-lg-end">
                                    <button type="submit" class="btn w-100 btn-lg btn-primary"> Cari <span
                                            class="iconify-inline" data-icon="fluent:search-20-filled"></span> </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- End Filter --}}
                </div>
                <div class="col-md-12">
                    <div class="card" style="min-height: 650px">
                        <div class="card-body">
                            <table id="tbl_list" class="table display dataTable table-hover" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>Kode RUP</th>
                                        <th>Nama Paket</th>
                                        <th>Status Dokumen</th>
                                        <th>Verifikasi</th>
                                        <th>Paket Tayang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Create project -->
    <div class="modal fade" id="create_project" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mulai membuat paket baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body custom_scroll">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <form id="form">
                        <ul class="nav nav-tabs tab-card px-0" role="tablist">
                            <li class="nav-item flex-fill text-center"><a class="nav-link active" href="#step1"
                                    data-bs-toggle="tab" data-bs-step="1">1. Kategori Paket</a></li>
                            <li class="nav-item flex-fill text-center"><a class="nav-link" href="#step2"
                                    data-bs-toggle="tab" data-bs-step="2">2. Detail Paket</a></li>
                            <li class="nav-item flex-fill text-center"><a class="nav-link" href="#step3"
                                    data-bs-toggle="tab" data-bs-step="3">3. Klasifikasi Paket</a></li>
                        </ul>

                        <!-- start: project status progress bar -->
                        <div class="progress bg-transparent" style="height: 3px; margin-top: -2px;">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="1" aria-valuemin="1"
                                aria-valuemax="5" style="width: 20%;"></div>
                        </div>
                        <div class="tab-content mt-3">
                            <!-- start: jenis pengadaan -->
                            <div class="tab-pane fade show active" id="step1">
                                <div class="card bg-body mb-2">
                                    <div class="card-body">
                                        <h6 class="card-title mb-1">Jenis Jenis Pengadaan</h6>
                                        <!-- Custome redio input -->
                                        <div class="c_radio d-flex flex-md-wrap">
                                            @foreach (getJenisPengadaan() as $d)
                                                <label class="m-1 w-100" for="jenis_pengadaan_{{ $d->id }}">
                                                    <input type="radio" name="jenis_pengadaan_id"
                                                        class="jenis_pengadaan_id"
                                                        id="jenis_pengadaan_{{ $d->id }}"
                                                        value="{{ $d->id }}" />
                                                    <span class="card">
                                                        <span class="card-body d-flex p-3">
                                                            <i class="fa fa-user"></i>
                                                            <span class="ms-3">
                                                                <span
                                                                    class="h6 d-flex mb-1">{{ $d->jenis_pengadaan }}</span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button class="btn bg-secondary text-light next text-uppercase">Selanjutnya</button>
                                </div>
                            </div>
                            <!-- start: paket detail -->
                            <div class="tab-pane fade" id="step2">
                                <div class="card bg-body mb-2">
                                    <div class="card-body">
                                        <h6 class="card-title mb-1">Paket Detail</h6>
                                        <p class="text-muted small">Isikan detail paket yang akan diajukan</p>
                                        <div class="form-floating mb-2">
                                            <input type="text" class="form-control" name="kode_rup" id="kode_rup"
                                                placeholder="Kode RUP">
                                            <label>Kode RUP *</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="text" class="form-control" name="nama_paket" id="nama_paket"
                                                placeholder="Nama Paket">
                                            <label>Nama Paket *</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="text" class="form-control" name="sumber_dana"
                                                id="sumber_dana" placeholder="Sumber Dana">
                                            <label>Sumber Dana *</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="text" class="form-control" name="nilai_hps_paket"
                                                id="nilai_hps_paket" placeholder="Nilai HPS Paket">
                                            <label>Nilai HPS Paket *</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="text" class="form-control" name="nilai_pagu_paket"
                                                id="nilai_pagu_paket" placeholder="Nilai Pagu Paket">
                                            <label>Nilai Pagu Paket *</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="text" class="form-control" name="lokasi_pekerjaan"
                                                id="lokasi_pekerjaan" placeholder="Lokasi Pekerjaan">
                                            <label>Lokasi Pekerjaan *</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="date" class="form-control" name="tgl_pembuatan"
                                                id="tgl_pembuatan">
                                            <label>Tanggal Pembuatan *</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <select class="form-select" name="tahun_anggaran" id="tahun_anggaran">
                                                @foreach (getTahun() as $d)
                                                    <option value="{{ $d }}">{{ $d }}</option>
                                                @endforeach
                                            </select>
                                            <label>Tahun Anggaran *</label>
                                        </div>


                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button class="btn bg-secondary text-light next text-uppercase">Pilih klasifikasi
                                        paket</button>
                                </div>
                            </div>
                            <!-- start: klasifikasi paket -->
                            <div class="tab-pane fade" id="step3">
                                <div class="card bg-body mb-2">
                                    <div class="card-body">
                                        <h6 class="card-title mb-1">Klasifikasi paket</h6>
                                        <ul class="list-group list-group-flush list-group-custom custom_scroll mb-0 mt-4"
                                            style="height: 300px;">
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="flex-fill ms-2">
                                                    <div class="h6 mb-0">Metode pengadaan</div>
                                                </div>
                                                <select class="form-select  form-select-sm w240"
                                                    name="metode_pengadaan_id" id="metode_pengadaan_id">
                                                    @foreach (getMetodePengadaan() as $d)
                                                        <option value="{{ $d->id }}">{{ $d->metode_pengadaan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="flex-fill ms-2">
                                                    <div class="h6 mb-0">Jenis Kontrak</div>
                                                </div>
                                                <select class="form-select  form-select-sm w240" name="jenis_kontrak_id"
                                                    id="jenis_kontrak_id">
                                                    @foreach (getJenisKontrak() as $d)
                                                        <option value="{{ $d->id }}">{{ $d->jenis_kontrak }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="flex-fill ms-2">
                                                    <div class="h6 mb-0">Kualifikasi Usaha</div>
                                                </div>
                                                <select class="form-select  form-select-sm w240"
                                                    name="kualifikasi_usaha_id" id="kualifikasi_usaha_id">
                                                    @foreach (getKualifikasiUsaha() as $d)
                                                        <option value="{{ $d->id }}">{{ $d->kualifikasi_usaha }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="flex-fill ms-2">
                                                    <div class="h6 mb-0">Jumlah Peserta Tender</div>
                                                </div>
                                                <input type="number" class="form-control w240" name="peserta_tender"
                                                    id="peserta_tender">

                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>

                                    <button type="submit" class="btn bg-success text-light text-uppercase"
                                        id="btn-selesai">Selesai</button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tbl_list').addClass('nowrap').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url()->current() }}",

                },
                columns: [{
                        data: 'kode_rup',
                        name: 'kode_rup'
                    },
                    {
                        data: 'nama_paket',
                        name: 'nama_paket'
                    },
                    {
                        data: 'status_dokumen',
                        name: 'status_dokumen'
                    },
                    {
                        data: 'status_verifikasi',
                        name: 'status_verifikasi'
                    },
                    {
                        data: 'status_tayang',
                        name: 'status_tayang'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ],
                "order": [
                    [0, "desc"]
                ]
            });

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btn-selesai").click(function(e) {

            e.preventDefault();
            let jenis_pengadaan_id = $("input[name='jenis_pengadaan_id']:checked").val();
            let submitButton = $("#form button[type='submit']");
            submitButton.prop("disabled", true);

            let kode_rup = $("#kode_rup").val();
            let nama_paket = $("#nama_paket").val();
            let sumber_dana = $("#sumber_dana").val();
            let nilai_hps_paket = $("#nilai_hps_paket").val();
            let tgl_pembuatan = $("#tgl_pembuatan").val();
            let metode_pengadaan_id = $("#metode_pengadaan_id").val();
            let tahun_anggaran = $("#tahun_anggaran").val();
            let nilai_pagu_paket = $("#nilai_pagu_paket").val();
            let jenis_kontrak_id = $("#jenis_kontrak_id").val();
            let lokasi_pekerjaan = $("#lokasi_pekerjaan").val();
            let kualifikasi_usaha_id = $("#kualifikasi_usaha_id").val();
            let peserta_tender = $("#peserta_tender").val();

            $.ajax({
                type: 'POST',
                url: "{{ route('paket.satker.store') }}",
                data: {
                    kode_rup: kode_rup,
                    nama_paket: nama_paket,
                    sumber_dana: sumber_dana,
                    nilai_hps_paket: nilai_hps_paket,
                    tgl_pembuatan: tgl_pembuatan,
                    jenis_pengadaan_id: jenis_pengadaan_id,
                    metode_pengadaan_id: metode_pengadaan_id,
                    tahun_anggaran: tahun_anggaran,
                    nilai_pagu_paket: nilai_pagu_paket,
                    jenis_kontrak_id: jenis_kontrak_id,
                    lokasi_pekerjaan: lokasi_pekerjaan,
                    kualifikasi_usaha_id: kualifikasi_usaha_id,
                    peserta_tender: peserta_tender
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        //alert(data.success);
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        submitButton.prop("disabled", false);
                        location.reload();
                    } else {
                        printErrorMsg(data.error);
                        submitButton.prop("disabled", false);
                    }
                }
            });

        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    </script>
@endpush
