<div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ url('ped-panel/list-supervisis') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari berdasarkan Project Name" value="{{ $search }}">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('ped-panel.admin.export.supervisi') }}" target="_blank" class="btn btn-primary"><i
                            class="fa fa-file-excel-o"></i> Eksports</a>
                </div>
            </div>
            <hr>
            <div class="box box-border">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>TEMATIK</th>
                                    <th>WITEL</th>
                                    <th>STO</th>
                                    <th>PROJECT NAME</th>
                                    <th>MITRA</th>
                                    <th>NO. SP TELKOM</th>
                                    <th>PROGRESS FISIK</th>
                                    <th>NAMA ODP</th>
                                    <th>STATUS GOLIVE</th>
                                    <th>KENDALA</th>
                                    <th>STATUS ABD</th>
                                    <th>ID SW</th>
                                    <th>ID IMON</th>
                                    <th>ODP PORT</th>
                                    <th>PLAN GOLIVE</th>
                                    <th>REAL GOLIVE</th>
                                    <th>TANGGAL BAST-1</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($supervisis as $d)
                                <tr>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->supervisi_project->tematik }}</td>
                                    <td>{{ $d->supervisi_project->witel_id }}</td>
                                    <td>{{ $d->supervisi_project->sto_id }}</td>
                                    <td>{{ $d->supervisi_project->lop_site_id }}</td>
                                    <td>{{ $d->supervisi_mitra->nama_mitra }}</td>
                                    <td>{{ $d->supervisi_sap ? $d->supervisi_sap->kontrak : '-' }}</td>
                                    <td>-</td>
                                    <td>{{ $d->supervisi_project->catuan_nama }}</td>
                                    <td>{{ $d->status_gl_sdi }}</td>
                                    <td>-</td>
                                    <td>{{$d->status_abd}}</td>
                                    <td>{{$d->id_sw}}</td>
                                    <td>{{$d->id_imon}}</td>
                                    <td>{{$d->odp_port}}</td>
                                    <td>{{$d->plan_golive}}</td>
                                    <td>{{$d->real_golive}}</td>
                                    <td>{{$d->tgl_bast_1}}</td>


                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="18"> Belum ada inventory</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
