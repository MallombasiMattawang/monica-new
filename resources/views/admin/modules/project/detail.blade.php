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
    <div class="col-md-8">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Detail Project <b>{{ $data->lop_site_id }} </b></h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_1-1" data-toggle="tab">Info</a></li>
                        <li><a href="#tab_2-2" data-toggle="tab">Feeder</a></li>
                        <li><a href="#tab_3-2" data-toggle="tab">Distribusi</a></li>
                        <li><a href="#odp" data-toggle="tab">ODP</a></li>
                        <li><a href="#odc" data-toggle="tab">ODC</a></li>
                        <li><a href="#summary-rab" data-toggle="tab">Summary & RAB</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">
                            <table class="table table-striped">
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                                <tr>
                                    <td>TIPE PROJECT</td>
                                    <td> <b>{{ $data->tipe_project }} </b> </td>
                                </tr>
                                <tr>
                                    <td>TEMATIK</td>
                                    <td> <b>{{ $data->tematik }} </b> </td>
                                </tr>
                                <tr>
                                    <td>WITEL </td>
                                    <td> <b>{{ $data->witel_id }} </b> </td>
                                </tr>
                                <tr>
                                    <td>STO</td>
                                    <td> <b>{{ $data->sto_id }} </b> </td>
                                </tr>
                                <tr>
                                    <td>LOP / SITE ID</td>
                                    <td> <b>{{ $data->lop_site_id }} </b> </td>
                                </tr>
                                <tr>
                                    <td>MITRA</td>
                                    <td> <b>{{ $data->mitra_id }} </b> | <b>{{ $data->mitra->nama_mitra }} </b> </td>
                                </tr>
                                <tr>
                                    <td>NDE PERMINTAAN</td>
                                    <td> <b>{{ $data->nde_permintaan }} </b> </td>
                                </tr>
                                <tr>
                                    <td>PERIHAL NDE</td>
                                    <td> <b>{{ $data->perihal_nde }} </b> </td>
                                </tr>
                                <tr>
                                    <td>TANGGAL NDE</td>
                                    <td> <b>{{ $data->tgl_nde }} </b> </td>
                                </tr>
                                <tr>
                                    <td>NILAI PERMINTAAN</td>
                                    <td> <b>{{ $data->nilai_permintaan }} </b> </td>
                                </tr>
                                <tr>
                                    <td>NDE PERMINTAAN</td>
                                    <td> <b>{{ $data->nde_pelimpahan }} </b> </td>
                                </tr>
                                {{-- <tr>
                                    <td>NOMOR KONTRAK</td>
                                    <td> <b>{{ $data->nomor_kontrak }} </b> </td>
                                </tr>
                                <tr>
                                    <td>STATUS SAP</td>
                                    <td> <b>{{ $data->status_sap }} </b> </td>
                                </tr> --}}

                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2-2">
                            <table class="table table-striped">
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                                <tr>
                                    <td>FEEDER KU KAP 12</td>
                                    <td> <b>{{ $data->feeder_ku_kap_12 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KU KAP 24</td>
                                    <td> <b>{{ $data->feeder_ku_kap_24 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KU KAP 48</td>
                                    <td> <b>{{ $data->feeder_ku_kap_48 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KU KAP 96</td>
                                    <td> <b>{{ $data->feeder_ku_kap_96 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KT KAP 24</td>
                                    <td> <b>{{ $data->feeder_kt_kap_24 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KT KAP 48</td>
                                    <td> <b>{{ $data->feeder_kt_kap_48 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KT KAP 96</td>
                                    <td> <b>{{ $data->feeder_kt_kap_96 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KT KAP 144</td>
                                    <td> <b>{{ $data->feeder_kt_kap_144 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>FEEDER KT KAP 288</td>
                                    <td> <b>{{ $data->feeder_kt_kap_288 }} </b> </td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3-2">
                            <table class="table table-striped">
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                                <tr>
                                    <td>DISTRIBUSI KU KAP 24 SCPT</td>
                                    <td> <b>{{ $data->distribusi_ku_kap_24_scpt }} </b> </td>
                                </tr>
                                <tr>
                                    <td>DISTRIBUSI KU KAP 12 SCPT</td>
                                    <td> <b>{{ $data->distribusi_ku_kap_12_scpt }} </b> </td>
                                </tr>
                                <tr>
                                    <td>DISTRIBUSI KU KAP 8 SCPT</td>
                                    <td> <b>{{ $data->distribusi_ku_kap_8_scpt }} </b> </td>
                                </tr>
                                <tr>
                                    <td>DISTRIBUSI KT KAP 24 SCPT</td>
                                    <td> <b>{{ $data->distribusi_kt_kap_24_scpt }} </b> </td>
                                </tr>
                                <tr>
                                    <td>DISTRIBUSI KT KAP 12 SCPT</td>
                                    <td> <b>{{ $data->distribusi_kt_kap_12_scpt }} </b> </td>
                                </tr>
                                <tr>
                                    <td>DISTRIBUSI KT KAP 8 SCPT</td>
                                    <td> <b>{{ $data->distribusi_kt_kap_8_scpt }} </b> </td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="odc">
                            <table class="table table-striped">
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                                <tr>
                                    <td>ODC 48</td>
                                    <td> <b>{{ $data->odc_odc_48 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>ODC 96</td>
                                    <td> <b>{{ $data->odc_odc_96 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>ODC 144</td>
                                    <td> <b>{{ $data->odc_odc_144 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>ODC 288</td>
                                    <td> <b>{{ $data->odc_odc_288 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>ODC 576</td>
                                    <td> <b>{{ $data->odc_576 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>ODC TOTAL</td>
                                    <td> <b>{{ $data->odc_total }} </b> </td>
                                </tr>
                            </table>

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="odp">
                            <table class="table table-striped">
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                                <tr>
                                    <td>ODP 8</td>
                                    <td> <b>{{ $data->odp_odp_8 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>ODP 16</td>
                                    <td> <b>{{ $data->odp_odp_16 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>ODP SPL 18</td>
                                    <td> <b>{{ $data->odp_spl_1_8 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>ODP SPL 16</td>
                                    <td> <b>{{ $data->odp_spl_1_16 }} </b> </td>
                                </tr>
                                <tr>
                                    <td>ODP PORT</td>
                                    <td> <b>{{ $data->odp_port }} </b> </td>
                                </tr>
                                <tr>
                                    <td>CATUAN JENIS</td>
                                    <td> <b>{{ $data->catuan_jenis }} </b> </td>
                                </tr>
                                <tr>
                                    <td>CATUAN NAMA</td>
                                    <td> <b>{{ $data->catuan_nama }} </b> </td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="summary-rab">
                            <table class="table table-striped">
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                                <tr>
                                    <td>PANJANG FEEDER</td>
                                    <td> <b>{{ $data->panjang_feeder }} </b> </td>
                                </tr>
                                <tr>
                                    <td>PANJANG DIST</td>
                                    <td> <b>{{ $data->panjang_dist }} </b> </td>
                                </tr>
                                <tr>
                                    <td>TIANG BARU</td>
                                    <td> <b>{{ $data->tiang_baru }} </b> </td>
                                </tr>
                                <tr>
                                    <td>JARAK KE STO</td>
                                    <td> <b>{{ $data->jarak_ke_sto }} </b> </td>
                                </tr>
                                <tr>
                                    <td>JUMLAH HOMEPASS</td>
                                    <td> <b>{{ $data->jml_home_pass }} </b> </td>
                                </tr>
                                <tr>
                                    <td>RAB MATERIAL</td>
                                    <td> <b>{{ separator($data->rab_material) }} </b> </td>
                                </tr>
                                <tr>
                                    <td>RAB SURVEY</td>
                                    <td> <b>{{ separator($data->rab_survey) }} </b> </td>
                                </tr>
                                <tr>
                                    <td>RAB TOTAL</td>
                                    <td> <b>{{ separator($data->rab_total) }} </b> </td>
                                </tr>
                                <tr>
                                    <td>NILAI CAPEX PER PORT</td>
                                    <td> <b>{{ $data->nilai_capex_per_port }} </b> </td>
                                </tr>


                            </table>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4">
        <div class="box box-solid {{ $color }}  ">
            <div class="box-body text-center">
                <h2>{{ $data->status_project }} </h2>
            </div>
        </div>

        <div class="box box-solid">
            <div class="box-body">
                <table class="table table-bordered text-center">
                    <tr>
                        <td>Start Project</td>
                        <td>Finish Finish</td>
                        {{-- <td>Durasi</td> --}}
                    </tr>
                    <tr>
                        <th> <b>{{ ($data->start_date) ? $data->start_date : '-' }} </b> </th>
                        <th> <b>{{ ($data->end_date) ? $data->end_date : '-' }} </b> </th>
                        {{-- <th> <b>{{ ($data->start_date && $data->end_date) ? $data->start_date->diff($data->end_date) : '-' }} </b> </th> --}}
                    </tr>

                </table>
            </div>
        </div>

        <div class="box box-solid">
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <td>Status SAP</td>
                        <th> <b>{{ ($data->sap) ? $data->sap->status_sap : '-' }} </b> </th>
                    </tr>
                    <tr>
                        <td>Nomor Kontrak</td>
                        <th> <b>{{ ($data->sap) ? $data->sap->kontrak : '-' }} </b> </th>
                    </tr>
                    <tr>
                        <td>NDE Pelimpahan</td>
                        <th> <b>{{ ($data->sap) ? $data->sap->ses_pelimpahan : '-' }} </b> </th>
                    </tr>
                </table>
            </div>
        </div>

        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">Tindak Lanjut Project</h3>
            </div>
            <div class="box-body bg-gray text-center">
                {{-- Admin::user()->inRoles(['administrator']) --}}
                @if ($data->status_project == 'USULAN')
                <a href="{{ url('/ped-panel/mst-projects/' . $data->id . '/edit') }}" class="btn btn-default "><i class="fa fa-edit"></i> <br> Edit Project</a>
                @endif
                @if (Admin::user()->inRoles(['administrator']))
                @if($data->status_project != 'DROP')
                <a href="#" class="btn btn-danger " data-toggle="modal" data-target="#modal-drop"><i class="fa fa-stop"></i> <br> Drop Project</a>
                <a href="#" class="btn btn-success " data-toggle="modal" data-target="#modal-start-finish"><i class="fa fa-play"></i> <br> Start Project</a>
                @else
                <a href="#" class="btn btn-app" data-toggle="modal" data-target="#modal-usulan"><i class="fa fa-repeat"></i>Usulkan Kembali</a>
                <a href="#" class="btn btn-app" data-toggle="modal" data-target="#modal-pulihkan"><i class="fa fa-refresh"></i>Pulihkan Supervisi</a>
                @endif
                @endif



            </div>
        </div>
    </div>
</div>
<b>{{-- modal action start-finish --}} </b>
<form action="{{url('ped-panel/submit-play-project')}}" method="POST" onsubmit="disableSubmitButton()">
    @csrf
    <input type="hidden" name="id" value="{{$data->id}}">
    <div class="modal fade" id="modal-start-finish">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Start dan Finish Project</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status Project</label>
                        <select class="form-control" id="status_project" name="status_project">
                            <option value="USULAN" {{ $data->status_project == 'USULAN' ? 'selected' : '' }}>USULAN
                            </option>
                            <option value="DONE DRM" {{ $data->status_project == 'DONE DRM' ? 'selected' : '' }}>DONE
                                DRM</option>
                            <option value="PELIMPAHAN" {{ $data->status_project == 'PELIMPAHAN' ? 'selected' : '' }}>
                                PELIMPAHAN</option>
                            <option value="PO" {{ $data->status_project == 'PO' ? 'selected' : '' }}>PO/SP
                            </option>
                            {{-- <option value="DROP" {{ $data->status_project == 'DROP' ? 'selected' : '' }}>DROP
                            </option> --}}
                        </select>
                    </div><!-- /.form-group -->

                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                        <label>Tanggal Start:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{$data->start_date}}">
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->

                    <!-- Date mm/dd/yyyy -->
                    <div class="form-group">
                        <label>Tanggal Finish:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{$data->end_date}}">
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-button" class="btn btn-primary">Save changes</button>
                </div>
            </div>

        </div>

    </div>
</form>

<form action="{{url('ped-panel/submit-drop-project')}}" method="POST" onsubmit="disableSubmitButton()">
    @csrf
    <input type="hidden" name="id" value="{{$data->id}}">
    <input type="hidden" name="status_project" value="DROP">
    <div class="modal modal-danger fade" id="modal-drop">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Drop Project</h4>
                </div>
                <div class="modal-body">
                    <p>Anda ingin melakukan DROP Project ini <b> {{ $data->lop_site_id }} </b>?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-button" class="btn btn-primary">YES</button>
                </div>
            </div>

        </div>

    </div>
</form>

<form action="{{url('ped-panel/submit-usulan-project')}}" method="POST" onsubmit="disableSubmitButton()">
    @csrf
    <input type="hidden" name="id" value="{{$data->id}}">
    <input type="hidden" name="status_project" value="USULAN">
    <div class="modal modal-warning fade" id="modal-usulan">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Usulkan Ulang Project</h4>
                </div>
                <div class="modal-body">
                    <p>Anda ingin melakukan Pengusulan kembali Project ini <b> {{ $data->lop_site_id }} </b>?</p>
                    <p>Tindakan ini akan mereset kembali project ini menjadi <b>USULAN</b> dan menghapus semua Basline, Plan, Supervisi, Inventory, Administrasi yang berjalan</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-button" class="btn btn-primary">YES</button>
                </div>
            </div>

        </div>

    </div>
</form>

<form action="{{url('ped-panel/submit-pulihkan-project')}}" method="POST" onsubmit="disableSubmitButton()">
    @csrf
    <input type="hidden" name="id" value="{{$data->id}}">
    <input type="hidden" name="status_project" value="USULAN">
    <div class="modal modal-primary fade" id="modal-pulihkan">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Pulihkan KembaliProject</h4>
                </div>
                <div class="modal-body">
                    <p>Anda ingin melakukan Pulihkan kembali Project ini <b> {{ $data->lop_site_id }} </b>?</p>
                    <p>Tindakan ini akan memulihkan kembali project ini menjadi <b>STATUS TERAKHIR DI TABEL SAP</b> dan Mengembalikan akses pengguna untuk Basline, Plan, Supervisi, Inventory, Administrasi yang berjalan</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-button" class="btn btn-primary">YES</button>
                </div>
            </div>

        </div>

    </div>
</form>


<script>
    var status = document.getElementById("status_project").value;
    if (status == "USULAN" || status == "DROP") {
        document.getElementById("start_date").disabled = true;
        document.getElementById("end_date").disabled = true;
    } else {
        document.getElementById("start_date").disabled = false;
        document.getElementById("end_date").disabled = false;
    }


    document.getElementById("status_project").onchange = function() {

        if (this.value == "USULAN" || this.value == "DROP") {
            document.getElementById("start_date").disabled = true;
            document.getElementById("end_date").disabled = true;
            document.getElementById("start_date").value = "";
            document.getElementById("end_date").value = "";
        } else {
            document.getElementById("start_date").disabled = false;
            document.getElementById("end_date").disabled = false;
        }
    };

</script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {
            "placeholder": "dd/mm/yyyy"
        });
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {
            "placeholder": "mm/dd/yyyy"
        });
        //Money Euro
        $("[data-mask]").inputmask();


    });

</script>
