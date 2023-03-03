@extends('pengguna.layouts.app')
@section('page_header')
    <div class="page-header pattern-bg">
        <div class="container-fluid">
            <div class="row">
                <div class=" mb-2">
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

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"> Change Password </h4>
                            @if ($messagxe = Session::get('sess_password'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <div class="d-flex">
                                        <i class='bx fs-5 bxs-check-circle'></i>
                                        {{ $messagxe }}
                                    </div>
                                    <button type="button" class="btn-close" data-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($old_password = Session::get('old_password'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <div class="d-flex">
                                        <i class='bx fs-5 bxs-check-circle'></i>
                                        {{ $old_password }}
                                    </div>
                                    <button type="button" class="btn-close" data-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (!empty($errors->all()))
                                <div class="alert alert-danger mt-lg-2" role="alert">

                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach

                                </div>
                            @endif


                            <form action="{{ route('user.update_password') }}" method="POST">
                                @csrf
                                <input type="hidden" name="role" value="{{ $getRole }}">
                                <input type="hidden" name="userId" value="{{ $getUserId }}">

                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" name="old_password" class="form-control" placeholder="Nama"
                                            autocomplete="off">
                                        <label>Password Lama <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" name="new_password" class="form-control" placeholder="Nama"
                                            required autocomplete="off">
                                        <label>Password Baru <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" name="new_password_confirmation" class="form-control"
                                            placeholder="Nama" required autocomplete="off">
                                        <label>Ketik Ulang Password Baru<span class="text-danger">*</span></label>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-danger btn-lg w-100"> Update Password </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
