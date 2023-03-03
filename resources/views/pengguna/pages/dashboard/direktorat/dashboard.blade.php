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
    
@endsection
