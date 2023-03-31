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
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="https://code.iconify.design/3/3.0.0/iconify.min.js"></script>
</head>

<body data-avio="theme-indigo">
    <div class="avio">
        <div class="page-body">
            <div class="container">
                <div class="row g-0 mt-lg-5">
                    <div class="col-lg-8 d-none d-lg-flex ">
                        <div style="margin-top:70px;">
                            <div style="margin-right: 50px; margin-top:50px;">
                                <div class="blog-banner py-1">
                                    <div class="">
                                        <div class="row g-xl-4 g-3 row-deck">
                                            <div class="col-12">
                                                <div class="card overflow-hidden">
                                                    <div class="carousel slide" data-bs-ride="carousel">
                                                        <div class="carousel-indicators justify-content-start">
                                                            <button type="button" data-bs-target="#blog_slider" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
                                                            <button type="button" data-bs-target="#blog_slider" data-bs-slide-to="1" aria-label="Slide 2" class="active" aria-current="true"></button>
                            
                                                        </div>
                                                        <div class="carousel-inner">
                                                            <div class="thumb-overlay carousel-item active" style="height: 100%;">
                                                                <img src="{{ asset('img/banner-1.png') }}" class="d-block w-100" alt="...">
                            
                                                            </div>
                                                            <div class="thumb-overlay carousel-item" style="height: 100%;">
                                                                <img src="{{ asset('img/banner-2.png') }}" class="d-block w-100" alt="...">
                            
                                                            </div>
                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- .row end -->
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                        <div class="card shadow p-4 p-md-5" style=" margin-top:70px;">
                            <form class="row g-2" action="{{ route('masuk') }}" method="POST">
                                @csrf
                                <input type="hidden" name="role" value="{{ $role }}">
                                <div class="text-center" style="margin-top: -70px;">
                                    <img src="{{ asset('img/telkom_indonesia_logo.png') }}" width="150px" alt="">
                                </div>
                                <div class="mb-2">
                                    <h5 class="color-900">Dashboard PED </h5>
                                    <p class="color-900">Login <strong>{{$role}}</strong> - Telkom Regional 7 </p>
                                </div>
                                @if (!empty($errors->all()))
                                <div class="alert alert-danger mt-lg-2" role="alert">

                                    @foreach ($errors->all() as $error)
                                    {{ $error }}
                                    @endforeach

                                </div>
                                @endif

                                <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="email" class="form-control form-control-lg" placeholder="name@example.com" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <div class="form-label">
                                            <span class="d-flex justify-content-between align-items-center"> Password
                                            </span>
                                        </div>
                                        <input type="password" name="password" class="form-control form-control-lg" placeholder="***************">
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg w-100 " title="">Masuk </button>
                                    <br><br>
                                    <a href="/" class=""> <u>  Kembali </u></a>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>


    <script src="{{ asset('js/theme.js') }}"></script>

</body>

</html>
