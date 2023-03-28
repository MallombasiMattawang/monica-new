<div class="row">
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
    <div class="col-md-6">
        <div class="box">
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Tgl</th>
                            <th>Activity</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td></td>
                            <td>Pembuatan Dokumen</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td></td>
                            <td>Pengiriman Dokumen ke WITEL</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td></td>
                            <td>Verifikasi WITEL</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">Tindak Lanjut</h3>
            </div>
            <div class="box-body text-center">
                @if($administrasi->posisi_doc == 'WITEL')
                    @if($administrasi->status_doc == 'VERIFIKASI DOKUMEN')
                        <a href="#" class="btn btn-danger " data-toggle="modal" data-target="#modal-reject-witel"><i class="fa fa-close"></i> <br> Reject Dokumen</a>
                        <a href="#" class="btn btn-success " data-toggle="modal" data-target="#modal-approve-witel"><i class="fa fa-check"></i> <br> Approve Dokumen</a>
                    @endif
                    @if($administrasi->status_doc == 'PROSES TANDA TANGAN WITEL')
                        <a href="#" class="btn btn-primary " data-toggle="modal" data-target="#modal-ttd-witel"><i class="fa fa-500px"></i> <br> TTD Dokumen</a>
                    @endif  
                @endif

                @if($administrasi->posisi_doc == 'TELKOM REGIONAL')
                    @if($administrasi->status_doc == 'VERIFIKASI DOKUMEN')
                        <a href="#" class="btn btn-danger " data-toggle="modal" data-target="#modal-reject-regional"><i class="fa fa-close"></i> <br> Reject Dokumen</a>
                        <a href="#" class="btn btn-success " data-toggle="modal" data-target="#modal-approve-regional"><i class="fa fa-check"></i> <br> Approve Dokumen</a>
                    @endif
                    @if($administrasi->status_ba_rekon == 'VERIFIKASI TELKOM REGIONAL')
                        <a href="#" class="btn btn-danger " data-toggle="modal" data-target="#modal-reject-ba"><i class="fa fa-close"></i> <br> Reject Ba Rekon</a>
                        <a href="#" class="btn btn-success " data-toggle="modal" data-target="#modal-approve-ba"><i class="fa fa-check"></i> <br> Approve BA Rekon</a>
                    @endif
                    @if($administrasi->status_doc == 'PROSES TANDA TANGAN TELKOM REGIONAL')
                        <a href="#" class="btn btn-primary " data-toggle="modal" data-target="#modal-ttd-regional"><i class="fa fa-500px"></i> <br> TTD Dokumen</a>
                    @endif  
                 @endif


            </div>
        </div>
    </div>
</div>

{{-- MODAL WITEL --}}
<form action="{{ url('/ped-panel/reject-administrasi-witel') }}" method="POST" onsubmit="disableSubmitButton()">
    @csrf
    <input type="hidden" name="id" value="{{$administrasi->id}}">
    <div class="modal fade modal-danger" id="modal-reject-witel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Reject Dokumen</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Catatan Witel</label>
                        <textarea class="form-control" rows="3" placeholder="Catatan ..." name="catatan_verifikator"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-button" class="btn btn-primary">Reject</button>
                </div>
            </div>

        </div>

    </div>
</form>

<form action="{{ url('/ped-panel/approve-administrasi-witel') }}" method="POST" onsubmit="disableSubmitButton()">
    @csrf
    <input type="hidden" name="id" value="{{$administrasi->id}}">
    <div class="modal fade modal-success" id="modal-approve-witel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Approve Dokumen</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Catatan Witel</label>
                        <textarea class="form-control" rows="3" placeholder="Catatan ..." name="catatan_verifikator"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-button" class="btn btn-primary">Approve</button>
                </div>
            </div>

        </div>

    </div>
</form>

<form action="{{ url('/ped-panel/ttd-administrasi-witel') }}" method="POST" enctype="multipart/form-data"  onsubmit="disableSubmitButton()">
    @csrf
    <input type="hidden" name="id" value="{{$administrasi->id}}">
    <div class="modal fade modal-primary" id="modal-ttd-witel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Tandatangani Dokumen</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file_doc">Dokumen yang Ditandatangani</label>
                        <input type="file" id="file_doc" name="file_doc">
                    </div>
                    <div class="form-group">
                        <label>Catatan Witel</label>
                        <textarea class="form-control" rows="3" placeholder="Catatan ..." name="catatan_verifikator"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-button" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </div>

    </div>
</form>

{{-- MODAL TELKOM REGIONAL --}}
<form action="{{ url('/ped-panel/reject-administrasi-regional') }}" method="POST" onsubmit="disableSubmitButton()">
    @csrf
    <input type="hidden" name="id" value="{{$administrasi->id}}">
    <div class="modal fade modal-danger" id="modal-reject-regional">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Reject Dokumen</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Catatan Telkom Regional</label>
                        <textarea class="form-control" rows="3" placeholder="Catatan ..." name="catatan_verifikator"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-button" class="btn btn-primary">Reject</button>
                </div>
            </div>

        </div>

    </div>
</form>

<form action="{{ url('/ped-panel/approve-administrasi-regional') }}" method="POST" onsubmit="disableSubmitButton()">
    @csrf
    <input type="hidden" name="id" value="{{$administrasi->id}}">
    <div class="modal fade modal-success" id="modal-approve-regional">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Approve Dokumen</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Catatan Telkom Regional</label>
                        <textarea class="form-control" rows="3" placeholder="Catatan ..." name="catatan_verifikator"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-button" class="btn btn-primary">Approve</button>
                </div>
            </div>

        </div>

    </div>
</form>

<form action="{{ url('/ped-panel/ttd-administrasi-regional') }}" method="POST" enctype="multipart/form-data"  onsubmit="disableSubmitButton()">
    @csrf
    <input type="hidden" name="id" value="{{$administrasi->id}}">
    <div class="modal fade modal-primary" id="modal-ttd-regional">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Tandatangani Dokumen</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file_doc">Dokumen yang Ditandatangani</label>
                        <input type="file" id="file_doc" name="file_doc">
                    </div>
                    <div class="form-group">
                        <label>Catatan Telkom Regional</label>
                        <textarea class="form-control" rows="3" placeholder="Catatan ..." name="catatan_verifikator"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-button" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </div>

    </div>
</form>

<form action="{{ url('/ped-panel/reject-administrasi-ba') }}" method="POST" onsubmit="disableSubmitButton()">
    @csrf
    <input type="hidden" name="id" value="{{$administrasi->id}}">
    <div class="modal fade modal-danger" id="modal-reject-ba">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Reject Dokumen</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Catatan Telkom Regional</label>
                        <textarea class="form-control" rows="3" placeholder="Catatan ..." name="catatan_verifikator"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-button" class="btn btn-primary">Reject</button>
                </div>
            </div>

        </div>

    </div>
</form>

<form action="{{ url('/ped-panel/approve-administrasi-ba') }}" method="POST" onsubmit="disableSubmitButton()">
    @csrf
    <input type="hidden" name="id" value="{{$administrasi->id}}">
    <div class="modal fade modal-success" id="modal-approve-ba">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Approve Dokumen</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Catatan Telkom Regional</label>
                        <textarea class="form-control" rows="3" placeholder="Catatan ..." name="catatan_verifikator"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-button" class="btn btn-primary">Approve</button>
                </div>
            </div>

        </div>

    </div>
</form>
