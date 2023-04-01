@extends('pengguna.layouts.app')

@section('page_header')
<div class="page-header pattern-bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-2">

                @include('pengguna.layouts.partials.breadcrumb')

                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h2 mb-md-0 text-white fw-light">{{ $pageTitle }} </h1>
                    <div class="page-action">

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('contents')
<!-- Start:: main page body area -->
<div class="page-body page-layout-1">
    <div class="container-fluid">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="row">
            <div class="col-12 mb-2">
                <div class="project-list d-flex flex-nowrap align-items-start">
                    <div class="order-1 sticky-lg-top shadow-sm">
                        <ul class="nav nav-tabs menu-list list-unstyled mb-0 border-0">
                            <li class="nav-item"><a class="nav-link active" href="#" data-bs-toggle="tab" data-bs-target="#pd_overview" role="tab">Overview</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#plan_activity" role="tab">Plan Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#actual_activity" role="tab">Actual Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#administrasi_activity" role="tab">Administrasi Activity</a></li>

                         
                            <li class="divider mt-4 py-2 border-top text-uppercase text-muted"></li>
                            <li>
                                <div class="mt-3 text-center">
                                    <div class="mb-0 fw-bold">{{ ($data->start_date) ? tgl_indo($data->start_date) : '-' }} - {{ ($data->end_date) ? tgl_indo($data->end_date) : '-' }}</div>
                                    <small class="text-muted">Start - Finish Project</small>

                                </div>
                            </li>
                            <li class="divider mt-4 py-2 border-top text-uppercase text-muted"><small>Waspang</small>
                            </li>
                            <li class="text-center">
                                <div class="circle">
                                    <img class="avatar xl rounded-circle img-thumbnail" src="{{ asset('img/xs/avatar9.jpg.png') }}" alt="">
                                </div>
                                <small class="mt-3 mb-0">{{ ($profil->supervisi_waspang) ? $profil->supervisi_waspang->name : '-' }}</small>
                                <small>Telp/WA: {{ ($profil->supervisi_waspang) ? $profil->supervisi_waspang->telepon : '-' }}</small>
                                
                            </li>
                           
                        </ul>
                    </div>
                    <div class="order-2 flex-grow-1 ps-lg-3 ps-0">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pd_overview" role="tabpanel">
                                <div class="d-flex justify-content-between p-3 bg-card rounded-4 mb-3">
                                    <h6 class="card-title mb-0"><a class="me-2 fa fa-arrow-circle-left" href="#" title="back"></a>Project Overview</h6>
                                    <button class="btn btn-sm d-block d-lg-none btn-primary project-list-toggle" type="button"><i class="fa fa-bars"></i></button>
                                </div>
                                <div class="alert alert-info" role="alert">
                                    <h6 class="alert-heading">Project Task !</h6>

                                    <p class="mb-0">{{ ucwords($profil->task)}}</p>
                            </div>
                            <div class="row g-3 row-deck">
                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <span class="fw-bold h4 mb-2">{{ $data->panjang_feeder }}</span>
                                            <div class="text-muted text-uppercase small">PANJANG FEEDER</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <span class="fw-bold h4 mb-2">{{ $data->panjang_dist }}</span>
                                            <div class="text-muted text-uppercase small">PANJANG DIST</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <span class="fw-bold h4 mb-2">{{ separator($data->rab_total) }}</span>
                                            <div class="text-muted text-uppercase small">RAB TOTAL</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <span class="fw-bold h4 mb-2">{{ $data->nilai_capex_per_port }}</span>
                                            <div class="text-muted text-uppercase small">NILAI CAPEX PER PORT</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-xl-7 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">Kurva S</h6>
                                            <!-- widgest: Card more action icon -->
                                            <div class="dropdown morphing scale-left">
                                                <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>

                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="line_target_real" style="width: 100%;"></canvas>
                                        </div>
                                    </div> <!-- .card end -->
                                </div>
                                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-4 col-sm-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">Info Project</h6>
                                            <!-- widgest: Card more action icon -->
                                            <div class="dropdown morphing scale-left">
                                                <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>

                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="d-flex">
                                                <table class="table ">
                                                    <tr>
                                                        <td><small class="text-muted">TIPE PROJECT</small></td>
                                                        <td><small class="text-muted"> <b>{{ $data->tipe_project }} </b> </small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><small class="text-muted">TEMATIK</small></td>
                                                        <td><small class="text-muted"> <b>{{ $data->tematik }} </b> </small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><small class="text-muted">WITEL</small></td>
                                                        <td><small class="text-muted"> <b>{{ $data->witel_id }} </b> </small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><small class="text-muted">STO</small></td>
                                                        <td><small class="text-muted"> <b>{{ $data->sto_id }} </b> </small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><small class="text-muted">START - FINISH</small></td>
                                                        <td><small class="text-muted"> <b>{{ ($data->start_date) ? tgl_indo($data->start_date) : '-' }} </b> - <b>{{ ($data->end_date) ? tgl_indo($data->end_date) : '-' }} </b> </small></td>
                                                    </tr>
                                                    <tr>
                                                        <td><small class="text-muted">TIANG BARU</small></td>
                                                        <td><small class="text-muted"> <b>{{ $data->tiang_baru }} </b> </small></td>
                                                    </tr>

                                                </table>
                                            </div>
                                            <div class="mt-3" id="apex-wc-12"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-4 col-sm-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="card-title">Milestones</h6>
                                            <!-- widgest: Card more action icon -->
                                            <div class="dropdown morphing scale-left">
                                                <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>

                                            </div>
                                        </div>
                                        <div class="bg-light py-3 px-4">
                                            <span>Preparing</span>
                                            <div class="progress mt-2" style="height: 5px;">
                                                <div class="progress-bar bg-primary-gradient" role="progressbar" aria-valuenow="{{ $stat_prepare }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $stat_prepare }}%;"></div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <span>Delivery</span>
                                            <div class="progress mt-2 mb-4" style="height: 5px;">
                                                <div class="progress-bar chart-color1" role="progressbar" aria-valuenow="{{ $stat_delivery }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $stat_delivery }}%;"></div>
                                            </div>
                                            <span>Instalation (Instalasi - CT)</span>
                                            <div class="progress mt-2 mb-4" style="height: 5px;">
                                                <div class="progress-bar chart-color2" role="progressbar" aria-valuenow="{{ $stat_instalasi }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $stat_instalasi }}%;"></div>
                                            </div>
                                            <span>Closing (UT - BAST)</span>
                                            <div class="progress mt-2 mb-4" style="height: 5px;">
                                                <div class="progress-bar chart-color3" role="progressbar" aria-valuenow="{{ $closing }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $closing }}%;"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-7 col-lg-12 col-md-4 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="card-title">Verifikator</h6>
                                            <!-- widgest: Card more action icon -->
                                            <div class="dropdown morphing scale-left">
                                                <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>

                                            </div>
                                        </div>
                                        <ul class="list-group list-group-flush list-group-custom mb-0">
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="avatar rounded-circle"><img class="avatar rounded-circle" src="{{ asset('img/xs/avatar1.jpg.png') }}" alt="friend"></div>
                                                <div class="flex-fill ms-3">
                                                    <div class="h6 mb-0">{{ ($profil->supervisi_waspang) ? $profil->supervisi_waspang->name : '-' }}</div>
                                                    <small class="text-muted">Waspang | Tlp. {{ ($profil->supervisi_waspang) ? $profil->supervisi_waspang->telepon : '-' }}</small>
                                                </div>
                                                <div class="flex-end avatar-list">

                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="avatar rounded-circle"><img class="avatar rounded-circle" src="{{ asset('img/xs/avatar3.jpg.png') }}" alt="friend"></div>
                                                <div class="flex-fill ms-3">
                                                    <div class="h6 mb-0">{{ ($profil->supervisi_tim_ut) ? $profil->supervisi_tim_ut->name : '-' }}</div>
                                                    <small class="text-muted">TIM UT | Tlp. {{ ($profil->supervisi_tim_ut) ? $profil->supervisi_tim_ut->telepon : '-' }}</small>
                                                </div>
                                                <div class="flex-end avatar-list">

                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="plan_activity" role="tabpanel">
                            <div class="d-flex justify-content-between p-3 bg-card rounded-4 mb-3">
                                <h6 class="card-title mb-0"><a class="me-2 fa fa-arrow-circle-left" href="#" title="back"></a>Project Plan Activity</h6>
                                <button class="btn btn-sm d-block d-lg-none btn-primary project-list-toggle" type="button"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <div id="container_plan"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="actual_activity" role="tabpanel">
                            <div class="d-flex justify-content-between p-3 bg-card rounded-4 mb-3">
                                <h6 class="card-title mb-0"><a class="me-2 fa fa-arrow-circle-left" href="#" title="back"></a>Project Actual Activity</h6>
                                <button class="btn btn-sm d-block d-lg-none btn-primary project-list-toggle" type="button"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <div id="container_actual"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="administrasi_activity" role="tabpanel">
                            <div class="d-flex justify-content-between p-3 bg-card rounded-4 mb-3">
                                <h6 class="card-title mb-0"><a class="me-2 fa fa-arrow-circle-left" href="#" title="back"></a>Administrasi Activity</h6>
                                <button class="btn btn-sm d-block d-lg-none btn-primary project-list-toggle" type="button"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <div id="container_administrasi"></div>
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
@endsection

@push('scripts')
<script>
    $('.project-list .project-list-toggle').on('click', function() {
        $('.project-list .order-1').toggleClass('open');
    });

</script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{ route('supervisi.plan', [$profil->id, Str::slug($profil->project_name)]) }}"
            , success: function(result) {
                $('#container_plan').html(result);
            }
        });

        $.ajax({
            url: "{{ route('supervisi.actual', [$profil->id, Str::slug($profil->project_name)]) }}"
            , success: function(result) {
                $('#container_actual').html(result);
            }
        });

        $.ajax({
            url: "{{ route('supervisi.administrasi', [$profil->id, Str::slug($profil->project_name)]) }}"
            , success: function(result) {
                $('#container_administrasi').html(result);
            }
        });
    });

</script>
<script>
    $(function() {

        var dateLabel = []
            , planData = []
            , actualData = []

        window.chartColors = {
            red: 'rgb(255, 99, 132)'
            , orange: 'rgb(255, 159, 64)'
            , yellow: 'rgb(255, 205, 86)'
            , green: 'rgb(75, 192, 192)'
            , blue: 'rgb(54, 162, 235)'
            , purple: 'rgb(153, 102, 255)'
            , grey: 'rgb(201, 203, 207)'
        };

        async function dummyChart() {
            await getDummyData()

            var config = {
                type: 'line'
                , data: {
                    labels: dateLabel
                    , datasets: [{
                            label: 'Bobot Plan'
                            , backgroundColor: window.chartColors.red
                            , borderColor: window.chartColors.red
                            , data: planData
                            , fill: false
                        , }
                        , {
                            label: 'Bobot Real'
                            , backgroundColor: window.chartColors.green
                            , borderColor: window.chartColors.green
                            , data: actualData
                            , fill: false
                        , },

                    ]
                }
                , options: {
                    responsive: true
                    , title: {
                        display: true
                        , text: 'Grafik Plan VS Grafik REAL'
                    }
                    , tooltips: {
                        mode: 'index'
                        , intersect: true
                    , }
                    , hover: {
                        mode: 'nearest'
                        , intersect: true
                    }
                    , scales: {
                        scaleShowValues: true
                        , xAxes: [{
                            ticks: {
                                autoSkip: true
                            }
                        }],

                        yAxes: [{
                            display: true
                            , scaleLabel: {
                                display: true
                                , labelString: 'Value'
                            }
                        }]
                    }
                }
            };

            var ctx = document.getElementById('line_target_real').getContext('2d');
            new Chart(ctx, config);
        }

        dummyChart()

        //Fetch Data from API

        async function getDummyData() {
            const apiUrl = "{{ url('/supervisi/kurva_s/' . $profil->project_id) }}"

            const response = await fetch(apiUrl)
            const barChatData = await response.json()

            const actual = barChatData.data.map((x) => x.bobot_real)
            // console.log(salary)
            const plan = barChatData.data.map((x) => x.bobot_plan)
            const date = barChatData.data.map((x) => x.date)

            actualData = actual
            planData = plan
            dateLabel = date

        }

    });

</script>
<script src="{{ asset('vendor/laravel-admin-ext/chartjs/Chart.bundle.min.js') }}"></script>
@endpush
