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
        <div class="card p-md-4 p-2">

            @foreach ($logs as $log)
            <div class="timeline-item ti-info ms-2">
                <div class="d-flex">
                    <img class="avatar sm rounded-circle" src="{{ asset('img/xs/avatar1.jpg.png') }}" alt="">
                    <div class="flex-fill ms-3">
                        <div class="row g-3">
                            <input type="hidden" name="baseline_id" value="{{$baseline->id}}">
                            <input type="hidden" name="activity_id" value="{{$baseline->activity_id}}">
                            <div class="col-6">
                                <label class="form-label">Volume Kontrak </label>
                                <input type="text" class="form-control" value="{{ $baseline->volume }}" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Satuan </label>
                                <input type="text" class="form-control" value="{{ $baseline->satuan }}" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Volume Dilaporkan </label>
                                <input type="text" class="form-control" value="{{ $log->actual_volume }}" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Satuan </label>
                                <input type="text" class="form-control" value="{{ $baseline->satuan }}" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Status Actual </label>
                                <input type="text" class="form-control" value="{{ $log->actual_status }}" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Waktu Dilaporkan </label>
                                <input type="text" class="form-control" value="{{ $log->created_at }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="actual_message" class="form-label">Remarks </label>
                                <textarea cols="30" rows="5" class="form-control" readonly>{{ $log->actual_message }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="actual_message" class="form-label">Kendala </label>
                                <textarea cols="30" rows="5" class="form-control" readonly>{{ $log->actual_kendala }}</textarea>
                            </div>
                            <div class="text-center p-5">
                                <img src="/uploads/{{ $log->actual_evident}}" onerror="this.onerror=null; this.src='/img/no-data.svg';" class="w120" />
                                <br><br>
                                <a href="/uploads/{{ $log->actual_evident}}" target="_blank" class="btn btn-primary border lift">Download Evident</a>
                            </div>
                            @if (activeGuard() == 'waspang' && $baseline->activity_id == 20)
                            <div class="col-12 text-end">
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reject">Reject</button>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approve">Approve</button>
                            </div>
                            @endif

                        </div>

                    </div>
                </div>
            </div> <!-- timeline item end  -->
            @endforeach



        </div>
    </div>
</div>
{{-- Modal Rejetc --}}
<div class="modal modal-danger fade" id="reject">
    <form action="{{route('supervisi.actual.approve')}}" method="POST">
        @csrf
        <input type="hidden" name="baseline_id" value="{{$baseline->id}}">
        <input type="hidden" name="activity_id" value="{{$baseline->activity_id}}">
        <input type="hidden" name="approval_waspang" value="REJECTED">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Reject Actual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin untuk Reject report ini ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
   
</div>
{{-- Modal Approve --}}
<div class="modal fade" id="approve">
    <form action="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Approve Actual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Woohoo, you're reading this text in a modal!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
