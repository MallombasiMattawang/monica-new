@extends('pengguna.layouts.app')

@section('page_header')
<div class="page-header pattern-bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-2">

                @include('pengguna.layouts.partials.breadcrumb')

                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h2 mb-md-0 text-white fw-light">Activity: {{ $pageTitle }} </h1>
                    <div class="page-action">

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
        <div class="row g-3 clearfix row-deck">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header py-3 bg-transparent border-bottom-0">
                        <h6 class="card-title mb-0"><i class="fa fa-edit"></i> Form Pengisian Actual Activity</h6>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        <form class="row g-3" action="{{route('supervisi.actual.adddate')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="baseline_id" value="{{$baseline->id}}">
                            <input type="hidden" name="activity_id" value="{{$baseline->activity_id}}">
                            @if ($baseline->activity_id >= 20)
                            <input type="hidden" name="actual_status" value="selesai">
                            @endif
                            <div class="col-6">
                                <label class="form-label">Volume Kontrak </label>
                                <input type="text" class="form-control" name="volume_kontrak" value="{{$baseline->volume}}" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Satuan </label>
                                <input type="text" class="form-control" name="satuan" value="{{$baseline->satuan}}" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Plan Start </label>
                                <input type="text" class="form-control" name="plan_start" value="{{tgl_indo($baseline->plan_start)}}" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Plan Finish </label>
                                <input type="text" class="form-control" name="plan_finish" value="{{tgl_indo($baseline->plan_finish)}}" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Volume Actual <sup class="text-danger">*</sup></label>
                                <input type="number" class="form-control" name="actual_volume" value="">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Volume Sebelumnya </label>
                                <input type="text" class="form-control" name="actual_volume_old" value="{{$actual_volume_old}}" readonly>
                            </div>
                            @if ($baseline->activity_id < 20)
                            <div class="col-12">
                                <label class="form-check-label me-3">Status Actual:<sup class="text-danger">*</sup></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="actual_status" id="actual_status1" value="belum">
                                    <label class="form-check-label" for="actual_status1">Belum</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="actual_status" id="actual_status2" value="selesai">
                                    <label class="form-check-label" for="actual_status2">Selesai</label>
                                </div>
                            </div>
                            @endif
                            
                            <div class="col-12">
                                <label class="form-label">Evident<sup class="text-danger">*</sup></label>
                                <input class="form-control" type="file" id="actual_evident" name="file">
                            </div>

                            <div class="col-md-6">
                                <label for="actual_message" class="form-label">Remarks<sup class="text-danger">*</sup></label>
                                <textarea name="actual_message" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="actual_message" class="form-label">Kendala</label>
                                <textarea name="actual_kendala" cols="30" rows="5" class="form-control"></textarea>
                            </div>


                            <div class="col-12 text-end">
                                <button class="btn btn-outline-secondary">Cancle</button>
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
