@extends('pengguna.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('cssbundle/dataTables.min.css') }}">
@endpush
@section('page_header')
    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class=" mb-2">
                    @include('pengguna.layouts.partials.breadcrumb')
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h2 mb-md-0 text-white fw-light">{{ $pageTitle }}</h1>
                        
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
                <div class="col-12 mb-0">
                    {{-- Filter --}}
                    <div class="p-3 bg-card  shadow  rounded-4 mb-4">
                        <input type="text" autofocus id="mySearchText" class="form-control" id="floatingInput"
                            placeholder="Cari apapun...">

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
                                        <th>LOP SITE ID</th>
                                        <th>Status: </th>
                                        <th></th>
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

    
@endsection
@push('scripts')
    <script src="{{ asset('js/bundle/dataTables.bundle.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tbl_list').addClass('nowrap').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                initComplete: function() {
                    $("#tbl_list_filter").hide();
                },
                ajax: {
                    // url: "{{ url()->current() }}",
                    url: "{{ route('project.json', 0) }}",

                },
                columns: [{
                        data: 'lop_site_id',
                        name: 'lop_site_id'
                    },
                    {
                        data: 'status_project',
                        name: 'status_project'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ],

            });
            $("#mySearchText").on('keyup', function() {
                $('#tbl_list').dataTable().fnFilter(this.value);
            });

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
