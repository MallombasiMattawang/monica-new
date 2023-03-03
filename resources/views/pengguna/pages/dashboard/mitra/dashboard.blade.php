@extends('pengguna.layouts.app')

@section('meta')
@endsection
@section('page_header')
    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class=" mb-2">
                    @include('pengguna.layouts.partials.breadcrumb')
                    <div class="d-flex">
                        <h1 class="h2 mb-md-0 text-white fw-light">{{ $pageTitle }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('contents')
    <div class="page-body">
        <div class="blog-banner py-4">
            <div class="">
                <div class="row g-xl-4 g-3 row-deck">
                    <div class="col-12">
                        <div class="card overflow-hidden">
                            <div class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators justify-content-start">
                                    <button type="button" data-bs-target="#blog_slider" data-bs-slide-to="0" class=""
                                        aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#blog_slider" data-bs-slide-to="1"
                                        aria-label="Slide 2" class="active" aria-current="true"></button>
                                    
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
        <div
            class="row row-cols-xxl-5 row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-1 g-2 mb-4 row-deck">
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex align-items-center p-xl-4 p-lg-3 p-2">
                        <div class="avatar lg rounded-circle no-thumbnail">
                            <i class="fa fa-dropbox fa-2x"></i>
                        </div>
                        <div class="flex-fill ms-3 text-truncate">
                            <div class="text-muted">Daftar Paket</div>
                            <div><span class="h6 fw-bold">104</span> <small class="text-muted">Paket</small></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex align-items-center p-xl-4 p-lg-3 p-2">
                        <div class="avatar lg rounded-circle no-thumbnail">
                            <i class="fa fa-bullhorn fa-2x"></i>
                        </div>
                        <div class="flex-fill ms-3 text-truncate">
                            <div class="text-muted">Paket Tayang</div>
                            <div><span class="h6 fw-bold">112</span> <small class="text-muted">Paket</small></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex align-items-center p-xl-4 p-lg-3 p-2">
                        <div class="avatar lg rounded-circle no-thumbnail">
                            <i class="fa fa-user-md fa-2x"></i>
                        </div>
                        <div class="flex-fill ms-3 text-truncate">
                            <div class="text-muted">Pemenang Paket</div>
                            <div><span class="h6 fw-bold">14</span> <small class="text-muted">Vendor</small></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex align-items-center p-xl-4 p-lg-3 p-2">
                        <div class="avatar lg rounded-circle no-thumbnail">
                            <i class="fa fa-tasks fa-2x"></i>
                        </div>
                        <div class="flex-fill ms-3 text-truncate">
                            <div class="text-muted">Monitoring Paket</div>
                            <div><span class="h6 fw-bold">98</span> <small class="text-muted">paket</small></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
