<div class="col-12">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header" style="margin-bottom: -40px">
                    <h6 class="mb-0">Progress Dokumen</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="my-3">
                                <div class="mb-0 fw-bold">{{ $administrasi->posisi_doc }}</div>
                                <small class="text-muted">Posisi Dokumen</small>
                            </div>
                            <div>
                                <div class="mb-0 fw-bold">{{ $administrasi->status_verfy }}</div>
                                <small class="text-muted">Progress Dokumen</small>
                            </div>
                        </div>

                        <div class="text-end">
                            <div class="my-3">
                                <div class="mb-0 fw-bold">{{ $administrasi->status_doc }}</div>
                                <small class="text-muted">Status Dokumen</small>
                            </div>

                        </div>
                    </div>



                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header" style="margin-bottom: -40px">
                    <h6 class="mb-0">Progress BA Rekon</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="my-3">
                                <div class="mb-0 fw-bold">{{ $administrasi->status_ba_rekon }}</div>
                                <small class="text-muted">Status BA Rekon</small>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (activeGuard() == 'mitra')
    <div class="card mb-5">
        <div class="card-header">
            <h6>Task Administrasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="myDataTable table table-hover">
                    <tr>
                        <th>No</th>
                        <th>Task</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td> <span class="fw-bold">Pembuatan Dokumen</span>
                            <div>
                                <span class="small text-muted me-2">Pembuatan dokumen dimulai setelah pelaksanaan UT</span>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td> <span class="fw-bold">Pengiriman Dokumen Ke Witel</span>
                            <div>
                                <span class="small text-muted me-2">Lakukan Pengiriman dokumen ke Witel jika pembuatan atau revisi dokumen selesai</span>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('supervisi.administrasi.form', [$baseline->id, 'docToWitel']) }}" class="btn btn-success {{ ($administrasi->status_doc == 'PEMBUATAN DOKUMEN' || $administrasi->status_verfy == 'REJECTED WITEL') && pendingItemUT($administrasi->project_id) == 0 ? '' : 'disabled' }} "> <i class="fa fa-upload"></i> Upload Doc </a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td> <span class="fw-bold">Pengiriman Dokumen Ke Regional</span>
                            <div>
                                <span class="small text-muted me-2">Lakukan Pengiriman dokumen ke Regional setelah di tandatangani WITEL untuk dilakukan verifikasi internal</span>
                            </div>
                        </td>
                        <td><a href="{{ route('supervisi.administrasi.form', [$baseline->id, 'docToRegional']) }}" class="btn btn-success {{ $administrasi->status_verfy == 'PENANDATANGANAN WITEL' || $administrasi->status_verfy == 'REJECTED INTERNAL' || $administrasi->status_verfy == 'REJECTED TELKOM REGIONAL' ? '' : 'disabled' }}"> <i class="fa fa-upload"></i> Upload Doc </a></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td> <span class="fw-bold">Verifikasi Internal</span>
                            <div>
                                <span class="small text-muted me-2">Lakukan verifikasi internal dan teruskan dokumen ke Telkom Regional</span>
                            </div>
                        </td>
                        <td><a href="{{ route('supervisi.administrasi.form', [$baseline->id, 'verifikasiInternal']) }}" class="btn btn-success {{ $administrasi->status_verfy == 'VERIFIKASI INTERNAL' ? '' : 'disabled' }}"> <i class="fa fa-check"></i> Verifikasi </a></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td> <span class="fw-bold">Pengiriman BA Rekonsiliasi</span>
                            <div>
                                <span class="small text-muted me-2">Lakukan Pengiriman BA Rekon ke Regional setelah status dokumen OK dan ditandatangani TELKOM Regional</span>
                            </div>
                        </td>
                        <td><a href="{{ route('supervisi.administrasi.form', [$baseline->id, 'docBaRekon']) }}" class="btn btn-success {{ ($administrasi->status_doc == 'DOKUMEN OK') &&  ($administrasi->status_ba_rekon == NULL || $administrasi->status_ba_rekon == 'REJECTED') ? '' : 'disabled' }}"> <i class="fa fa-check"></i> Upload BA Rekon </a></td>
                    </tr>

                </table>
            </div>
        </div>

    </div>

    <div class="card mb-5">
        <div class="card-header">
            <h6>Timeline Administrasi</h6>
        </div>
        <div class="card-body">
            @forelse ($log_administrasi as $log)
            <div class="timeline-item ti-danger ms-2">
                <div class="d-flex">
                    <img class="avatar sm rounded-circle" src="{{ asset('img/xs/avatar1.jpg.png') }}" alt="">
                    <div class="flex-fill ms-3">
                        <div class="mb-1">Status Dokumen <strong>{{ $log->status_doc }}</strong></div>
                        <span class="d-flex text-muted mb-3 small">Dilakukan pada - {{ tgl_indo($log->created_at) }} Oleh <a class="ms-2" href="#" title=""><strong>{{ $log->posisi_doc }}</strong></a>, Progres : <strong>{{ $log->status_verfy }}</strong></span>
                        <div class="card p-3">
                            Remarks : <br>
                            {{ $log->remarks }} <br><br>
                            Catatan Verifikator : <br>
                            {{ $log->catatan_verifikator }}
                        </div>
                        @if ($log->file_doc)
                        <a href="/uploads/{{ $log->file_doc }}" target="_blank" class="btn btn-primary btn-xs">Download</a>
                        @endif
                    </div>
                </div>
            </div> <!-- timeline item end  -->
            @empty

            @endforelse

        </div>

    </div>
    {{-- modal ro witel --}}
    <div class="modal fade" id="to_witel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ route('supervisi.docToWitel',  [$baseline->id, Str::slug($baseline->list_activity)]) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kirim Dokumen ke Witel</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="docToWitel" class="form-label">Dokumen ke WITEL</label>
                            <input class="form-control" type="file" id="docToWitel" name="docToWitel">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary submit-modal">Submit </button>


                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- modal ro regional --}}
    <div class="modal fade" id="to_regional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ route('supervisi.docToRegional', [$baseline->id, Str::slug($baseline->list_activity)]) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kirim Dokumen ke Regional</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="docToRegional" class="form-label">Dokumen ke Regional</label>
                            <input class="form-control" type="file" id="docToRegional" name="docToRegional">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary submit-modal">Submit </button>


                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- modal verifikasi internal --}}
    <div class="modal fade" id="ver_internal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ route('supervisi.verifikasiInternal', [$baseline->id, Str::slug($baseline->list_activity)]) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Verifikasi Internal</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="verifikasiInternal" class="form-label">Verifikasi Internal</label>
                            <input class="form-control" type="file" id="verifikasiInternal" name="verifikasiInternal">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary submit-modal">Submit </button>


                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- modal ro regional --}}
    <div class="modal fade" id="to_ba_rekon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ route('supervisi.docBaRekon', [$baseline->id, Str::slug($baseline->list_activity)]) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kirim BA Rekonsiliasi ke Regional</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="docBaRekon" class="form-label">Dokumen BA Rekonsiliasi</label>
                            <input class="form-control" type="file" id="docBaRekon" name="docBaRekon">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary submit-modal">Submit </button>


                    </div>
                </div>
            </form>
        </div>
    </div>

    @endif



</div>
