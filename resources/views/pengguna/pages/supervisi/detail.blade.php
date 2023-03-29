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
        <div class="row">
            <div class="col-12 mb-2">
                <div class="project-list d-flex flex-nowrap align-items-start">
                    <div class="order-1 sticky-lg-top shadow-sm">
                        <ul class="nav nav-tabs menu-list list-unstyled mb-0 border-0">
                            <li class="nav-item"><a class="nav-link active" href="#" data-bs-toggle="tab" data-bs-target="#pd_overview" role="tab">Overview</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#plan_activity" role="tab">Plan Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#actual_activity" role="tab">Actual Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#administrasi_activity" role="tab">Administrasi Actual</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#pd_activity" role="tab">Inventory</a></li>
                            
                            {{-- <li class="divider mt-4 py-2 border-top text-uppercase text-muted"><small>Project Cost</small></li> --}}
                            {{-- <li>
                                <h2 class="fw-normal">$8,890</h2>
                                <div class="mt-3">
                                    <div class="mb-0 fw-bold">22 Feb 2022</div>
                                    <small class="text-muted">Due Date</small>
                                </div>
                            </li> --}}
                            <li class="divider mt-4 py-2 border-top text-uppercase text-muted"><small>Waspang</small></li>
                            <li>
                                <div class="circle">
                                    <img class="avatar xl rounded-circle img-thumbnail" src="{{ asset('img/xs/avatar9.jpg.png') }}" alt="">
                                </div>
                                <h6 class="mt-3 mb-0">Michelle Green</h6>
                                <span>mchelle-green@info.com</span>
                                <button class="btn btn-outline-secondary btn-sm mt-3">Message</button>
                            </li>
                        </ul>
                    </div>
                    <div class="order-2 flex-grow-1 ps-lg-3 ps-0">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pd_overview" role="tabpanel">
                                <div class="d-flex justify-content-between p-3 bg-card rounded-4 mb-3">
                                    <h6 class="card-title mb-0"><a class="me-2 fa fa-arrow-circle-left" href="app-project.html" title="back"></a>Project Overview</h6>
                                    <button class="btn btn-sm d-block d-lg-none btn-primary project-list-toggle" type="button"><i class="fa fa-bars"></i></button>
                                </div>
                                <div class="alert alert-success" role="alert">
                                    <h6 class="alert-heading">Project Task !</h6>

                                    <p class="mb-0">{{ ucwords($profil->task)}}</p>
                                </div>
                                <div class="row g-3 row-deck">
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <span class="fw-bold h4 mb-2">1.5K</span>
                                                <div class="text-muted text-uppercase small">Upfront Payment</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <span class="fw-bold h4 mb-2">3.5K</span>
                                                <div class="text-muted text-uppercase small">Invoice Sent</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <span class="fw-bold h4 mb-2">4K</span>
                                                <div class="text-muted text-uppercase small">Payment Received</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <span class="fw-bold h4 mb-2">1.7K</span>
                                                <div class="text-muted text-uppercase small">Amount Pending</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12 col-xl-7 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">Tasks Over Time</h6>
                                                <!-- widgest: Card more action icon -->
                                                <div class="dropdown morphing scale-left">
                                                    <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>
                                                    <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                    <ul class="dropdown-menu shadow border-0 p-2">
                                                        <li><a class="dropdown-item" href="#">File Info</a></li>
                                                        <li><a class="dropdown-item" href="#">Copy to</a></li>
                                                        <li><a class="dropdown-item" href="#">Move to</a></li>
                                                        <li><a class="dropdown-item" href="#">Rename</a></li>
                                                        <li><a class="dropdown-item" href="#">Block</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
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
                                                <h6 class="card-title mb-0">Tasks Summary</h6>
                                                <!-- widgest: Card more action icon -->
                                                <div class="dropdown morphing scale-left">
                                                    <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>
                                                    <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                    <ul class="dropdown-menu shadow border-0 p-2">
                                                        <li><a class="dropdown-item" href="#">File Info</a></li>
                                                        <li><a class="dropdown-item" href="#">Copy to</a></li>
                                                        <li><a class="dropdown-item" href="#">Move to</a></li>
                                                        <li><a class="dropdown-item" href="#">Rename</a></li>
                                                        <li><a class="dropdown-item" href="#">Block</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-body text-center pt-0">
                                                <div class="d-flex">
                                                    <div class="card flex-fill me-1 px-2 py-3">
                                                        <h6 class="mb-0 fw-bold">27</h6>
                                                        <small class="text-muted">RESOLVED</small>
                                                    </div>
                                                    <div class="card flex-fill ms-1 px-2 py-3">
                                                        <h6 class="mb-0 fw-bold">13</h6>
                                                        <small class="text-muted">ISSUES</small>
                                                    </div>
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
                                                    <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                    <ul class="dropdown-menu shadow border-0 p-2">
                                                        <li><a class="dropdown-item" href="#">File Info</a></li>
                                                        <li><a class="dropdown-item" href="#">Copy to</a></li>
                                                        <li><a class="dropdown-item" href="#">Move to</a></li>
                                                        <li><a class="dropdown-item" href="#">Rename</a></li>
                                                        <li><a class="dropdown-item" href="#">Block</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="bg-light py-3 px-4">
                                                <span>Overall progress</span>
                                                <div class="progress mt-2" style="height: 5px;">
                                                    <div class="progress-bar bg-primary-gradient" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;"></div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <span>App Ui design</span>
                                                <div class="progress mt-2 mb-4" style="height: 5px;">
                                                    <div class="progress-bar chart-color1" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                                                </div>
                                                <span>Desktop app development</span>
                                                <div class="progress mt-2 mb-4" style="height: 5px;">
                                                    <div class="progress-bar chart-color2" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%;"></div>
                                                </div>
                                                <span>Website design</span>
                                                <div class="progress mt-2 mb-4" style="height: 5px;">
                                                    <div class="progress-bar chart-color3" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%;"></div>
                                                </div>
                                                <span>QA Analyst</span>
                                                <div class="progress mt-2" style="height: 5px;">
                                                    <div class="progress-bar chart-color4" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-7 col-lg-12 col-md-4 col-sm-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title">Project Team</h6>
                                                <!-- widgest: Card more action icon -->
                                                <div class="dropdown morphing scale-left">
                                                    <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>
                                                    <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                    <ul class="dropdown-menu shadow border-0 p-2">
                                                        <li><a class="dropdown-item" href="#">File Info</a></li>
                                                        <li><a class="dropdown-item" href="#">Copy to</a></li>
                                                        <li><a class="dropdown-item" href="#">Move to</a></li>
                                                        <li><a class="dropdown-item" href="#">Rename</a></li>
                                                        <li><a class="dropdown-item" href="#">Block</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <ul class="list-group list-group-flush list-group-custom mb-0">
                                                <li class="list-group-item d-flex align-items-center">
                                                    <div class="avatar rounded-circle"><img class="avatar rounded-circle" src="./assets/img/xs/avatar3.jpg" alt="friend"></div>
                                                    <div class="flex-fill ms-3">
                                                        <div class="h6 mb-0">Chris Fox</div>
                                                        <small class="text-muted">Design Lead</small>
                                                    </div>
                                                    <div class="flex-end avatar-list">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar3.jpg" alt="friend">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar1.jpg" alt="friend">
                                                    </div>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <div class="avatar rounded-circle"><img class="avatar rounded-circle" src="./assets/img/xs/avatar8.jpg" alt="friend"></div>
                                                    <div class="flex-fill ms-3">
                                                        <div class="h6 mb-0">Cindy Anderson</div>
                                                        <small class="text-muted">Marketing Lead</small>
                                                    </div>
                                                    <div class="flex-end avatar-list">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar3.jpg" alt="friend">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar1.jpg" alt="friend">
                                                    </div>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <div class="avatar rounded-circle"><img class="avatar rounded-circle" src="./assets/img/xs/avatar4.jpg" alt="friend"></div>
                                                    <div class="flex-fill ms-3">
                                                        <div class="h6 mb-0">Maryam Amiri</div>
                                                        <small class="text-muted">Dev Lead</small>
                                                    </div>
                                                    <div class="flex-end avatar-list">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar2.jpg" alt="friend">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar5.jpg" alt="friend">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar5.jpg" alt="friend">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar8.jpg" alt="friend">
                                                    </div>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <div class="avatar rounded-circle"><img class="avatar rounded-circle" src="./assets/img/xs/avatar1.jpg" alt="friend"></div>
                                                    <div class="flex-fill ms-3">
                                                        <div class="h6 mb-0">Alexander</div>
                                                        <small class="text-muted">QA Lead</small>
                                                    </div>
                                                    <div class="flex-end avatar-list">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar5.jpg" alt="friend">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar7.jpg" alt="friend">
                                                    </div>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <div class="avatar rounded-circle"><img class="avatar rounded-circle" src="./assets/img/xs/avatar7.jpg" alt="friend"></div>
                                                    <div class="flex-fill ms-3">
                                                        <div class="h6 mb-0">Joge Lucky</div>
                                                        <small class="text-muted">Sales Lead</small>
                                                    </div>
                                                    <div class="flex-end avatar-list">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar3.jpg" alt="friend">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar1.jpg" alt="friend">
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
                            <div class="tab-pane fade" id="pd_settings" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Project Settings</h6>
                                        <button class="btn btn-sm d-block d-lg-none btn-primary project-list-toggle" type="button"><i class="fa fa-bars"></i></button>
                                    </div>
                                    <form class="card-body">
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Project Icon</label>
                                            <div class="col-md-10">
                                                <div class="avatar lg rounded-circle no-thumbnail"><i class="fa fa-google fa-2x"></i></div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Project Name</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control form-control-lg">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Project Type</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control form-control-lg">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Project Description</label>
                                            <div class="col-md-10">
                                                <textarea type="text" class="form-control form-control-lg" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Due Date</label>
                                            <div class="col-lg-3 col-md-5 col-md-10">
                                                <input type="date" class="form-control form-control-lg">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Notifications</label>
                                            <div class="col-md-10">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="n_Phone">
                                                    <label class="form-check-label" for="n_Phone">Phone</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="n_email" checked="">
                                                    <label class="form-check-label" for="n_email">Email</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Status</label>
                                            <div class="col-md-10">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="Status" checked="">
                                                    <label class="form-check-label" for="Status">Active</label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="card-footer text-end">
                                        <button type="button" class="btn btn-lg btn-white border lift">Discard</button>
                                        <button type="button" class="btn btn-lg btn-primary border lift">Save Changes</button>
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

        var dateLabel = [],
            planData = [],
            actualData = []

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };

        async function dummyChart() {
            await getDummyData()

            var config = {
                type: 'line',
                data: {
                    labels: dateLabel,
                    datasets: [{
                            label: 'Bobot Plan',
                            backgroundColor: window.chartColors.red,
                            borderColor: window.chartColors.red,
                            data: planData,
                            fill: false,
                        },
                        {
                            label: 'Bobot Real',
                            backgroundColor: window.chartColors.green,
                            borderColor: window.chartColors.green,
                            data: actualData,
                            fill: false,
                        },

                    ]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Grafik Plan VS Grafik REAL'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        scaleShowValues: true,
                        xAxes: [{
                            ticks: {
                                autoSkip: true
                            }
                        }],
                        
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
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
            const apiUrl = "{{ url('/ped-panel/api/kurva_s/'.$profil->project_id) }}"

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
