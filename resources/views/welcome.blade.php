<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Dashboard PED - Aplikasi Manajemen Paket Proyek Mitra Telkom Regional 7">
    <meta name="keyword" content="Dashboard PED - Aplikasi Manajemen Paket Proyek Mitra Telkom Regional 7">
    <link rel="icon" href="{{ asset('img/avatar.png') }}" type="image/x-icon">
    <title>Dashboard PED - Aplikasi Manajemen Paket Proyek Mitra Telkom Regional 7</title>
    <link rel="stylesheet" href="{{ asset('css/avio-style.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="https://code.iconify.design/3/3.0.0/iconify.min.js"></script>

</head>

<body data-avio="theme-indigo">
    <div class="avio">
        <!-- Start:: main body header -->
        <div class="body-header sticky-md-top">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <!-- Header:: Brand icon -->
                    <a class="navbar-brand d-flex align-items-center color-900" href="index.html">
                        <svg width="48" height="36" viewBox="0 0 48 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect class="fill-secondary" x="1.5" y="4.5" width="27" height="27" rx="13.5" />
                            <rect class="fill-primary" x="13.5" y="1.5" width="33" height="33" rx="16.5" stroke="white" stroke-width="3" />
                        </svg>

                        <span class="h4 mb-0 fw-bold ps-2">Dashboard PED</span>

                    </a>

                    <!-- Header:: icon and user profile -->
                    <ul class="nav navbar-right d-flex align-items-center mb-0 list-unstyled">
                        <!-- start: quick light dark -->
                        <li>
                            <a class="nav-link quick-light-dark" href="#">
                                <i class="bi bi-moon"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <!-- Start:: breadcrumb, btn action, and quick tab bar -->
        <div class="page-header pattern-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mb-5">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="#">Dashboard PED</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tentang</li>
                        </ol>
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="h2 mb-md-0 text-white fw-light">Aplikasi Manajemen Mitra TR-7</h1>

                        </div>
                        <br>
                        @if (session('status'))
                        <div class="alert alert-danger">
                            {{ session('status') }}
                        </div>
                        @endif
                    </div>
                </div> <!-- row:: End -->

            </div>
        </div>
        <!-- Start:: main page body area -->
        <div class="page-body">
            <div class="container-fluid">
                <div class="row g-xl-4 g-lg-3 g-2 row-deck">
                    <div class="row row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-1 g-2 mb-4 row-deck">


                        <div class="col">
                            <div class="card text-center">

                                <div class="card-body d-flex align-items-center justify-content-between flex-column">
                                    <div class="me-auto ms-auto py-4">
                                        <img class="avatar rounded m-1 lift" src="{{ asset('img/xs/avatar1.jpg.png') }}" data-bs-toggle="tooltip" data-placement="top" title="" alt="" data-bs-original-title="Avatar Name" aria-label="Avatar Name">
                                        <img class="avatar rounded m-1 lift" src="{{ asset('img/xs/avatar2.jpg.png') }}" data-bs-toggle="tooltip" data-placement="top" title="" alt="" data-bs-original-title="Avatar Name" aria-label="Avatar Name">
                                        <img class="avatar rounded m-1 lift" src="{{ asset('img/xs/avatar3.jpg.png') }}" data-bs-toggle="tooltip" data-placement="top" title="" alt="" data-bs-original-title="Avatar Name" aria-label="Avatar Name">
                                        <img class="avatar rounded m-1 lift" src="{{ asset('img/xs/avatar4.jpg.png') }}" data-bs-toggle="tooltip" data-placement="top" title="" alt="" data-bs-original-title="Avatar Name" aria-label="Avatar Name">
                                        <img class="avatar rounded m-1 lift" src="{{ asset('img/xs/avatar5.jpg.png') }}" data-bs-toggle="tooltip" data-placement="top" title="" alt="" data-bs-original-title="Avatar Name" aria-label="Avatar Name">
                                        <img class="avatar rounded m-1 lift" src="{{ asset('img/xs/avatar6.jpg.png') }}" data-bs-toggle="tooltip" data-placement="top" title="" alt="" data-bs-original-title="Avatar Name" aria-label="Avatar Name">
                                    </div>
                                    <div class="mt-2">
                                        <h5 class="mb-0">Mitra Telkom </h5>
                                        <hr>
                                        <a href="{{ route('login', ['mitra']) }}" class="btn btn-primary " title="">Login Mitra</a>
                                    </div>
                                </div>
                            </div> <!-- .Card End -->
                        </div>
                        <div class="col">
                            <div class="card text-center">

                                <div class="card-body d-flex align-items-center justify-content-between flex-column">
                                    <div class="me-auto ms-auto py-4">
                                        <img class="avatar rounded m-1 lift" src="{{ asset('img/xs/avatar6.jpg.png') }}" data-bs-toggle="tooltip" data-placement="top" title="" alt="" data-bs-original-title="Avatar Name" aria-label="Avatar Name">
                                        <img class="avatar rounded m-1 lift" src="{{ asset('img/xs/avatar7.jpg.png') }}" data-bs-toggle="tooltip" data-placement="top" title="" alt="" data-bs-original-title="Avatar Name" aria-label="Avatar Name">
                                        <img class="avatar rounded m-1 lift" src="{{ asset('img/xs/avatar8.jpg.png') }}" data-bs-toggle="tooltip" data-placement="top" title="" alt="" data-bs-original-title="Avatar Name" aria-label="Avatar Name">
                                    </div>
                                    <div class="mt-2">
                                        <h5 class="mb-0">Waspang</h5>
                                        <hr>
                                        <a href="{{ route('login', ['waspang']) }}" class="btn btn-primary " title="">Login Waspang</a>
                                    </div>
                                </div>
                            </div> <!-- .Card End -->
                        </div>
                        <div class="col">
                            <div class="card text-center">

                                <div class="card-body d-flex align-items-center justify-content-between flex-column">
                                    <div class="me-auto ms-auto py-4">
                                        <img class="avatar rounded m-1 lift" src="{{ asset('img/xs/avatar8.jpg.png') }}" data-bs-toggle="tooltip" data-placement="top" title="" alt="" data-bs-original-title="Avatar Name" aria-label="Avatar Name">
                                        <img class="avatar rounded m-1 lift" src="{{ asset('img/xs/avatar9.jpg.png') }}" data-bs-toggle="tooltip" data-placement="top" title="" alt="" data-bs-original-title="Avatar Name" aria-label="Avatar Name">
                                        <img class="avatar rounded m-1 lift" src="{{ asset('img/xs/avatar10.jpg.png') }}" data-bs-toggle="tooltip" data-placement="top" title="" alt="" data-bs-original-title="Avatar Name" aria-label="Avatar Name">

                                    </div>
                                    <div class="mt-2">
                                        <h5 class="mb-0">Tim UT</h5>
                                        <hr>
                                        <a href="{{ route('login', ['tim-ut']) }}" class="btn btn-primary " title="">Login Tim UT</a>
                                    </div>
                                </div>
                            </div> <!-- .Card End -->
                        </div>
                        <div class="col">
                            <div class="card text-center">

                                <div class="card-body d-flex align-items-center justify-content-between flex-column">
                                    <div class="me-auto ms-auto py-4">
                                        <img class="avatar rounded m-1 lift" src="{{ asset('img/xs/avatar8.jpg.png') }}" data-bs-toggle="tooltip" data-placement="top" title="" alt="" data-bs-original-title="Avatar Name" aria-label="Avatar Name">
                                        <img class="avatar rounded m-1 lift" src="{{ asset('img/xs/avatar9.jpg.png') }}" data-bs-toggle="tooltip" data-placement="top" title="" alt="" data-bs-original-title="Avatar Name" aria-label="Avatar Name">
                                        <img class="avatar rounded m-1 lift" src="{{ asset('img/xs/avatar10.jpg.png') }}" data-bs-toggle="tooltip" data-placement="top" title="" alt="" data-bs-original-title="Avatar Name" aria-label="Avatar Name">

                                    </div>
                                    <div class="mt-2">
                                        <h5 class="mb-0">HD-PED, WITEL, SDI</h5>
                                        <hr>
                                        <a href="{{ url('ped-panel') }}" class="btn btn-primary " title="">Login Now</a>
                                    </div>
                                </div>
                            </div> <!-- .Card End -->
                        </div>



                    </div>


                </div>

            </div> <!-- .row end -->
        </div>
    </div>
   

    <!-- Modal: Setting -->
    <div class="modal fade" id="SettingsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-vertical right-side modal-dialog-scrollable">
            <div class="modal-content">
                <div class="px-xl-4 modal-header">
                    <h5 class="modal-title">Theme Setting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="px-xl-4 modal-body custom_scroll">
                    <!-- start: Light/dark -->
                    <div class="card fieldset border setting-mode mb-4">
                        <span class="fieldset-tile bg-card">Light/Dark & Contrast Layout</span>
                        <div class="c_radio d-flex text-center">
                            <label class="m-1 theme-switch" for="theme-switch">
                                <input type="checkbox" id="theme-switch" />

                            </label>
                            <label class="m-1 theme-dark" for="theme-dark">
                                <input type="checkbox" id="theme-dark" />

                            </label>
                            <label class="m-1 theme-high-contrast" for="theme-high-contrast">
                                <input type="checkbox" id="theme-high-contrast" />

                            </label>
                            <label class="m-1 theme-rtl" for="theme-rtl">
                                <input type="checkbox" id="theme-rtl" />

                            </label>
                        </div>
                    </div>

                </div>
                <div class="px-xl-4 modal-footer d-flex justify-content-start text-center">
                    <button type="button" class="btn flex-fill btn-primary lift">Save Changes</button>
                    <button type="button" class="btn flex-fill btn-white border lift" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/theme.js') }}"></script>

</body>

</html>
