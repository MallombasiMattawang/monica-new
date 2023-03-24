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
                            @if ($baseline->activity_id == 20)
                            <div class="col-md-6">
                                <label class="form-label">Status Approval </label>
                                <input type="text" class="form-control" value="{{ $log->approval_waspang }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="actual_message" class="form-label">Catatan Waspang </label>
                                <textarea cols="30" rows="5" class="form-control" readonly>{{ $log->approval_message }}</textarea>
                            </div>
                            @endif
                            @if ($baseline->activity_id == 21)
                            <div class="col-md-6">
                                <label class="form-label">Status Approval </label>
                                <input type="text" class="form-control" value="{{ $log->approval_tim_ut }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="actual_message" class="form-label">Catatan Tim UT </label>
                                <textarea cols="30" rows="5" class="form-control" readonly>{{ $log->approval_message }}</textarea>
                            </div>
                            @endif
                            <div class="text-center p-5">
                                <img src="/uploads/{{ $log->actual_evident}}" onerror="this.onerror=null; this.src='/img/no-data.svg';" class="w120" />
                                <br><br>
                                <a href="/uploads/{{ $log->actual_evident}}" target="_blank" class="btn btn-primary border lift">Download Evident</a>
                            </div>
                          

                        </div>

                    </div>
                </div>
            </div> <!-- timeline item end  -->
            @endforeach
            @if (activeGuard() == 'waspang' && $baseline->activity_id == 20 && $log->approval_waspang == null)
                <div class="col-12 text-end">
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reject_waspang">Reject</button>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approve_waspang">Approve</button>
                </div>
            @endif
            @if (activeGuard() == 'tim-ut' && $baseline->activity_id == 21 && $log->approval_tim_ut == null)
            <div class="col-12 text-end">
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reject_ut">Reject</button>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approve_ut">Approve</button>
            </div>
        @endif


        </div>
    </div>
</div>
{{-- Modal Rejetc waspang --}}
<div class="modal fade" id="reject_waspang">
    <form action="{{route('supervisi.actual.waspang')}}" method="POST">
        @csrf
        <input type="hidden" name="baseline_id" value="{{$baseline->id}}">
        <input type="hidden" name="activity_id" value="{{$baseline->activity_id}}">
        <input type="hidden" name="approval_waspang" value="REJECTED">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Reject Actual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin untuk Reject report ini ?</p>
                    <div class="col-md-12">
                        <label for="actual_message" class="form-label">Catatan Verifikator </label>
                        <textarea cols="30" rows="5" class="form-control" name="approval_message"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit-button">Save changes</button>
                </div>
            </div>
        </div>
    </form>
   
</div>
{{-- Modal Approve waspang --}}
<div class="modal fade" id="approve_waspang">
    <form action="{{route('supervisi.actual.waspang')}}" method="POST">
        @csrf
        <input type="hidden" name="baseline_id" value="{{$baseline->id}}">
        <input type="hidden" name="activity_id" value="{{$baseline->activity_id}}">
        <input type="hidden" name="approval_waspang" value="APPROVED">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Approve Actual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin untuk Approve report ini ?</p>
                    <div class="col-md-12">
                        <label for="actual_message" class="form-label">Catatan Verifikator </label>
                        <textarea cols="30" rows="5" class="form-control" name="approval_message"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit-button">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- Modal Rejetc tim-ut --}}
<div class="modal fade" id="reject_ut">
    <form action="{{route('supervisi.actual.ut')}}" method="POST">
        @csrf
        <input type="hidden" name="baseline_id" value="{{$baseline->id}}">
        <input type="hidden" name="activity_id" value="{{$baseline->activity_id}}">
        <input type="hidden" name="approval_tim_ut" value="REJECTED">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Reject Actual UT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin untuk Reject report ini ?</p>
                    <div class="col-md-12">
                        <label for="actual_message" class="form-label">Catatan Verifikator </label>
                        <textarea cols="30" rows="5" class="form-control" name="approval_message"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit-button">Save changes</button>
                </div>
            </div>
        </div>
    </form>
   
</div>
{{-- Modal Approve tim-ut --}}
<div class="modal fade" id="approve_ut">
    <form action="{{route('supervisi.actual.ut')}}" method="POST">
        @csrf
        <input type="hidden" name="baseline_id" value="{{$baseline->id}}">
        <input type="hidden" name="activity_id" value="{{$baseline->activity_id}}">
        <input type="hidden" name="approval_tim_ut" value="APPROVED">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Approve Actual UT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin untuk Approve report ini ?</p>
                    <div class="col-md-12">
                        <label for="actual_message" class="form-label">Catatan Verifikator </label>
                        <textarea cols="30" rows="5" class="form-control" name="approval_message"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit-button">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
