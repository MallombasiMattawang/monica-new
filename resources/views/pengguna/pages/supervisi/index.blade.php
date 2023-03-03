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
                        <a class="btn d-none d-sm-inline-flex bg-success rounded-pill text-white" href="" target="_blank" title="">
                            <span class="me-1 d-none d-lg-inline-block"> Aktif : 10/123 </span>
                        </a>

                        <button class="btn d-none d-sm-inline-flex rounded-pill" data-bs-toggle="modal" data-bs-target="#create_project" type="button">
                            <span class="me-1 d-none d-lg-inline-block"> <span class="iconify-inline" data-width="16" data-icon="fluent:add-28-regular"></span> Tambah Sekolah </span>
                        </button>
                        <a class="btn d-none d-sm-inline-flex bg-secondary rounded-pill text-dark" href="" target="_blank" title="">
                            <span class="me-1 d-none d-lg-inline-block">Export</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('contents')
<div class="page-body">
    <div class="container-fluid">

        <div class="row justify-content-between">
            <div class="col-12 mb-2">
                {{-- Filter --}}
                <div class="p-3 bg-card  shadow  rounded-4 mb-4">
                    <form action="">
                            <input type="hidden" name="page" value="{{ request()->input('page') }}">
                    <div class="row">
                        
                        <div class="col-md-10 mb-1">
                            <div class="form-floating">
                                <input type="text" name="keyword" class="form-control" value="{{ request()->input('keyword') }}" placeholder="Cari Project" autocomplete="off">
                                <label>Cari Project</label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-1 text-lg-end">
                            <button type="submit" class="btn w-100 btn-lg btn-primary"> Cari <span class="iconify-inline" data-icon="fluent:search-20-filled"></span> </button>
                        </div>
                    </div>
                    </form>
                </div>
                {{-- End Filter --}}
            </div>

            <div class="col-12">
                <div class="project-list d-flex flex-nowrap align-items-start">
                    <div class="flex-grow-1  ps-0">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="project_all" role="tabpanel">

                                <div class="row g-3" id="dataSekolah">

                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">

                                        <div id="load_more" class="col-12">
                                            <center>
                                                <button type="button" name="load_more_button" class="btn btn-success " id="load_more_button">Load
                                                    More</button>
                                            </center>
                                        </div>

                                        <div class="auto-load text-center">
                                            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                                <path fill="#000" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="limit text-danger text-center" style="display: none;">
                                            We don't have more data to display
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

@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        var ENDPOINT = "{{ url('/') }}";
        var page = 0;
        infinteLoadMore(page);

        $(document).on('click', '#load_more_button', function() {
            var id = $('.hello:last').attr('id');
            console.log(id);
            $('#load_more_button').html('<b>Loading...</b>');
            infinteLoadMore(id);
        });


        function infinteLoadMore(page) {
            $.ajax({
                    url: ENDPOINT + "/supervisi/index?skip=" + page + "&{!! request()->getQueryString() !!}"
                    , datatype: "html"
                    , type: "get"
                    , beforeSend: function() {
                        $('.auto-load').show();
                    }
                })

                .done(function(response) {
                    if (response.length == 0) {
                        $('.auto-load').html("We don't have more data to display ");
                        $('.limit').show();
                        $('#load_more_button').hide();
                    }

                    $('.auto-load').hide();
                    $("#dataSekolah").append(response);
                    $('#load_more_button').html('<b>Load More</b>');


                    console.log(page)
                    console.log("{{ request()->getQueryString() }}")
                })

                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }

    })

</script>
@endpush
