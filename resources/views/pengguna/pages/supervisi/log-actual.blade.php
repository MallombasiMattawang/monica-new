@extends('pengguna.layouts.app')

@section('page_header')
<div class="page-header pattern-bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-2">

                @include('pengguna.layouts.partials.breadcrumb')

                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h2 mb-md-0 text-white fw-light">Activity: {{ $pageTitle }} </h1>
                    <div class="page-action text-center">
                        @if (activeGuard() == 'waspang' && $baseline->activity_id == 20 && $supervisi->task == 'NEED APPROVED WASPANG' )
                        <div class="text-end">
                            <button class="btn bg-danger" data-bs-toggle="modal" data-bs-target="#reject_waspang">Reject</button>
                            <button class="btn bg-success" data-bs-toggle="modal" data-bs-target="#approve_waspang">Approve</button>
                        </div>
                        @endif
                        @if (activeGuard() == 'tim-ut' && $baseline->activity_id == 21 && $supervisi->task == 'NEED APPROVED TIM UT')
                        <div class="text-end">
                            <button class="btn bg-danger" data-bs-toggle="modal" data-bs-target="#reject_ut">Reject</button>
                            <button class="btn bg-success" data-bs-toggle="modal" data-bs-target="#approve_ut">Approve</button>
                        </div>
                        @endif

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
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="card p-md-4 p-2">
                    @foreach ($logs as $log)
                    <div class="timeline-item ti-info ms-2" style="display: inline;">
                        <div class="d-flex">
                            <img class="avatar sm rounded-circle" src="{{ asset('img/xs/avatar1.jpg.png') }}" alt="">
                            <div class="flex-fill ms-3">
                                <div class="row g-3">
                                    <div class="table-responsive">
                                        <table class="table no-footer dtr-inline">
                                            <tbody>
                                                <tr>
                                                    <td>Volume Kontrak</td>
                                                    <td> <b>{{ $baseline->volume }} {{ $baseline->satuan }}</b> </td>
                                                </tr>
                                                <tr>
                                                    <td>Waktu Dilaporkan</td>
                                                    <td> <b>{{ $log->created_at }} </b> </td>
                                                </tr>
                                                <tr>
                                                    <td>Waktu Dilaporkan</td>
                                                    <td> <b>{{ $log->actual_volume }} {{ $baseline->satuan }}</b> </td>
                                                </tr>
                                                <tr>
                                                    <td>Status Dilaporkan</td>
                                                    <td> <b>{{ $log->actual_status }}</b> </td>
                                                </tr>
                                                <tr>
                                                    <td>Remarks</td>
                                                    <td> <b>{{ $log->actual_message }}</b> </td>
                                                </tr>
                                                <tr>
                                                    <td>Kendala</td>
                                                    <td> <b>{{ $log->kendala }}</b> </td>
                                                </tr>
                                                <tr>
                                                    <td>Evident</td>
                                                    <td>
                                                        <p>
                                                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapse_{{ $log->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                File Evident
                                                            </a>
                                                        </p>
                                                        <div class="collapse" id="collapse_{{ $log->id }}">
                                                            @foreach(explode(',', $log->actual_evident) as $file)
                                                            <a href="{{ asset('uploads/evident/' . $file) }}" target="_blank">{{ $file }}</a><br>
                                                            @endforeach

                                                            
                                                        </div>
                                                    </td>
                                                </tr>
                                                @if ($baseline->activity_id == 20)
                                                <tr>
                                                    <td>Approval Waspang</td>
                                                    <td> <b>{{ $log->approval_waspang }}</b> </td>
                                                </tr>
                                                <tr>
                                                    <td>Catatan Waspang</td>
                                                    <td> <b>{{ $log->approval_message }}</b> </td>
                                                </tr>

                                                @endif
                                                @if ($baseline->activity_id == 21)
                                                <tr>
                                                    <td>Approval Waspang</td>
                                                    <td> <b>{{ $log->approval_tim_ut }}</b> </td>
                                                </tr>
                                                <tr>
                                                    <td>Catatan Waspang</td>
                                                    <td> <b>{{ $log->approval_message }}</b> </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>



                                </div>

                            </div>
                        </div>
                    </div> <!-- timeline item end  -->
                    @endforeach
                </div>
            </div>

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
