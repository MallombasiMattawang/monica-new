<div class="col-12">

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="myDataTable table table-hover">
                    <tr>
                        <th rowspan="2" class="text-center bg-light disabled "> List
                            Activity </th>
                        <th colspan="3" class="text-center bg-light-warning">BASELINE
                        </th>

                        <th colspan="3" class="text-center bg-light-info">
                            PROGRESS
                            ACTUAL
                        </th>
                        <th colspan="3" class="text-center bg-light-success">
                            ACTUAL
                        </th>
                    </tr>
                    <tr>
                        <th class="bg-light-warning text-center">Bobot</th>
                        <th class="bg-light-warning text-center">Volume</th>
                        <th class="bg-light-warning text-center">Satuan</th>
                        <th class="bg-light-info text-center"> Volume</th>
                        <th class="bg-light-info text-center"> Progress</th>
                        <th class="bg-light-info text-center"> Durasi</th>
                        <th class="bg-light-success text-center"> Start</th>
                        <th class="bg-light-success text-center"> Finish</th>
                        <th class="bg-light-success text-center"> Status</th>
                    </tr>
                    @php
                    $n = 0;
                    @endphp
                    @foreach ($lists as $list)
                    @php
                    $n++;
                    @endphp
                    <tr>
                        <td class=""> {{ $list->list_activity }} <br> </td>
                        <td class="text-center"> {{ $list->bobot }}</td>
                        <td class=" text-center">{{ $list->volume }} </td>
                        <td class=" text-center"> {{ $list->satuan }} </td>
                        <td class="text-center"> {{ $list->actual_start ? $list->actual_volume : '' }} </td>
                        <td class=" text-center">{{ $list->actual_start ? Round((int)$list->actual_progress, 1) . '%' : '' }}</td>
                        <td class="text-center"> {{ $list->actual_durasi }} </td>
                        <td class="text-center"> {{ $list->actual_start ? tgl_indo($list->actual_start) : '' }}</td>
                        <td class="text-center"> {{ $list->actual_finish ? tgl_indo($list->actual_finish) : '' }} </td>
                        <td class="text-center">
                            @if ($list->actual_task == 'APPROVED')
                            <span class="badge bg-success">{{ $list->actual_task }}</span>
                            @elseif ($list->actual_task == 'NEED APPROVED')
                            <span class="badge bg-info">{{ $list->actual_task }}</span>
                            @elseif ($list->actual_task == 'NEED UPDATED')
                            <span class="badge bg-warning">{{ $list->actual_task }}</span>
                            @else
                            <span class="badge bg-danger">{{ $list->actual_task }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>

                <table class="myDataTable table table-hover">
                    <thead>
                        <tr>
                            <th>Status Dokumen</th>
                            <th>Progress Dokumen</th>
                            <th>Status Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $administrasi->status_doc }}</td>
                            <td>{{ $administrasi->posisi_doc }}</td>
                            <td>{{ $administrasi->status_verfy }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="myDataTable table table-hover">
                    <thead>
                        <tr>
                            <th>Status Dokumen</th>
                            <th>Progress Dokumen</th>
                            <th>Status Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $administrasi->status_doc }}</td>
                            <td>{{ $administrasi->posisi_doc }}</td>
                            <td>{{ $administrasi->status_verfy }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <p>Task Administrasi</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="myDataTable table table-hover">
                    <tr>
                        <th>No</th>
                        <th>Task</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Pembuatan Dokumen</td>
                        <td> {{ $baseline->actual_finish }}</td>
                        <td>Pembuatan dokumen dimulai setelah pelaksanaan UT {{ $administrasi->posisi_doc }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Pengiriman Dokumen Ke Witel</td>
                        <td></td>
                        <td> 
                            @if ($administrasi->posisi_doc == 'MITRA AREA')
                                <p>Lakukan Pengiriman dokumen ke Witel jika pembuatan atau revisi dokumen selesai</p>
                            @elseif($administrasi->posisi_doc == 'WITEL')
                                <p><a href="http://" target="_blank" rel="noopener noreferrer">Dokumen</a> anda telah dikirim, mohon tunggu verifikasi dan TTD dari WITEL </p>
                            @endif    
                        </td>
                        
                        <td>
                            <a href="{{ route('supervisi.administrasi.form', [$baseline->id, 'docToWitel']) }}" class="btn btn-success {{ $administrasi->status_verfy == NULL || $administrasi->status_verfy == 'REJECTED WITEL'? '' : 'disabled' }} "> <i class="fa fa-upload"></i> Upload Doc </a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Pengiriman Dok. Ke Regional</td>
                        <td></td>
                        <td></td>
                        <td><a href="{{ route('supervisi.administrasi.form', [$baseline->id, 'docToRegional']) }}" class="btn btn-success {{ $administrasi->status_verfy == 'PENANDATANGANAN WITEL' || $administrasi->status_verfy == 'REJECTED INTERNAL' || $administrasi->status_verfy == 'REJECTED TELKOM REGIONAL' ? '' : 'disabled' }}"> <i class="fa fa-upload"></i> Upload Doc </a></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Verifikasi Internal</td>
                        <td></td>
                        <td></td>
                        <td><a href="{{ route('supervisi.administrasi.form', [$baseline->id, 'verifikasiInternal']) }}" class="btn btn-success {{ $administrasi->status_verfy == 'VERIFIKASI INTERNAL' ? '' : 'disabled' }}"> <i class="fa fa-check"></i> Verifikasi </a></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Pengiriman BA Rekonsiliasi</td>
                        <td></td>
                        <td></td>
                        <td><a href="{{ route('supervisi.administrasi.form', [$baseline->id, 'docBaRekon']) }}" class="btn btn-success {{ ($administrasi->status_doc == 'DOKUMEN OK') &&  ($administrasi->status_ba_rekon == NULL || $administrasi->status_ba_rekon == 'REJECTED') ? '' : 'disabled' }}"> <i class="fa fa-check"></i> Upload BA Rekon </a></td>
                    </tr>

                </table>
            </div>
        </div>

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
