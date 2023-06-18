<div class="row">
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Detail Supervisi</h3>
                <div class="box-tools pull-right">
                    <a href="{{ url('/ped-panel/tran-supervisis') }}" class="btn btn-default"><i
                            class="fa fa-arrow-left"></i> Back </a>
                </div>
            </div>
            <div class="box-body no-padding">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_actual" data-toggle="tab">Actual Activity</a></li>
                        <li><a href="#tab_inventory" data-toggle="tab">Inventory</a></li>
                        <li><a href="#tab_administrasi" data-toggle="tab">Administrasi</a></li>
                        <li><a href="#tab_info_supervisi" data-toggle="tab">Detail</a></li>
                        <li><a href="#kurva" data-toggle="tab">Kurva S</a></li>

                    </ul>
                    <div class="tab-content">
                        <!-- /.tab-pane -->
                        <div class="tab-pane active" id="tab_actual">


                            <table class="table table-bordered">
                                <tr>
                                    <td>Status Project </td>
                                    <td> <b>{{ $data->status_project }} </b> </td>
                                </tr>
                                <tr>
                                    <td>Start-Finish</td>
                                    <td> <b>{{ $data->start_date ? tgl_indo($data->start_date) : '-' }} </b> -
                                        <b>{{ $data->end_date ? tgl_indo($data->end_date) : '-' }} </b> </td>
                                </tr>
                                <tr>
                                    <td>Waspang</td>
                                    <td> {{ $supervisi->supervisi_waspang ? $supervisi->supervisi_waspang->name : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tim UT</td>
                                    <td> {{ $supervisi->supervisi_tim_ut ? $supervisi->supervisi_tim_ut->name : '-' }}
                                    </td>
                                </tr>



                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_inventory">
                            <table class="table table-striped">

                                <tr>
                                    <td>Status GL SDI</td>
                                    <td> {{ $supervisi->status_gl_sdi }} </td>
                                </tr>
                                <tr>
                                    <td>Keterangan GL SDI</td>
                                    <td> {{ $supervisi->ket_gl_sdi }} </td>
                                </tr>
                                <tr>
                                    <td>Status ABD</td>
                                    <td> {{ $supervisi->status_abd }} </td>
                                </tr>
                                <tr>
                                    <td>ID SW</td>
                                    <td> {{ $supervisi->id_sw }} </td>
                                </tr>
                                <tr>
                                    <td>ID IMON</td>
                                    <td> {{ $supervisi->id_imon }} </td>
                                </tr>
                                <tr>
                                    <td>ODP 8</td>
                                    <td> {{ $supervisi->odp_8 }} </td>
                                </tr>
                                <tr>
                                    <td>ODP 16</td>
                                    <td> {{ $supervisi->odp_16 }} </td>
                                </tr>
                                <tr>
                                    <td>ODP PORT</td>
                                    <td> {{ $supervisi->odp_port }} </td>
                                </tr>
                                {{-- <tr>
                                    <td>ODP NAME</td>
                                    <td> {{ $supervisi->nama_odp }} </td>
                                </tr> --}}
                                <tr>
                                    <td>Plan GOLIVE</td>
                                    <td> {{ $supervisi->plan_golive }} </td>
                                </tr>
                                <tr>
                                    <td>Real GOLIVE</td>
                                    <td> {{ $supervisi->real_golive }} </td>
                                </tr>

                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_administrasi">
                            <table class="table table-striped">

                                <tr>
                                    <td>Status Dokumen</td>
                                    <td> {{ $supervisi->status_doc }} </td>
                                </tr>
                                <tr>
                                    <td>Posisi Dokumen</td>
                                    <td> {{ $supervisi->posisi_doc }} </td>
                                </tr>
                                <tr>
                                    <td>Progress Dokumen</td>
                                    <td> {{ $supervisi->progress_doc }} </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Selesai CT</td>
                                    <td> {{ $tgl_ct ? tgl_indo($tgl_ct->actual_finish) : '-' }} </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Selesai UT</td>
                                    <td> {{ $tgl_ut ? tgl_indo($tgl_ct->actual_finish) : '-' }} </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Rekonsiliasi</td>
                                    <td> {{ $tgl_rekon ? tgl_indo($tgl_ct->actual_finish) : '-' }} </td>
                                </tr>
                                <tr>
                                    <td>Tanggal BAST</td>
                                    <td> {{ $smilley ? tgl_indo($smilley->actual_finish) : '-' }} </td>
                                </tr>
                                <tr>
                                    <td>Durasi CT</td>
                                    <td> {{ $tgl_ct ? $tgl_ct->actual_durasi : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Durasi Rekonsiliasi</td>
                                    <td> {{ $tgl_rekon ? $tgl_ct->actual_durasi : '-' }}</td>
                                </tr>

                            </table>
                        </div>
                        <div class="tab-pane" id="tab_info_supervisi">

                            <table class="table table-striped">
                                <tr>
                                    <td>EDC</td>
                                    <td> {{ $supervisi->edc }} </td>
                                </tr>
                                <tr>
                                    <td>TOC</td>
                                    <td> {{ $supervisi->toc }} </td>
                                </tr>

                                <tr>
                                    <td>Plan Homepass</td>
                                    <td> {{ $supervisi->plan_homepass }} </td>
                                </tr>
                                <tr>
                                    <td>Real Homepass</td>
                                    <td> {{ $supervisi->real_homepass }} </td>
                                </tr>
                                <tr>
                                    <td>Material BAST-1</td>
                                    <td> {{ $supervisi->material_bast_1 }} </td>
                                </tr>
                                <tr>
                                    <td>Jasa BAST-1</td>
                                    <td> {{ $supervisi->jasa_bast_1 }} </td>
                                </tr>
                                <tr>
                                    <td>Total BAST-1</td>
                                    <td> {{ $supervisi->total_bast_1 }} </td>
                                </tr>
                                <tr>
                                    <td>Total Akhir</td>
                                    <td> {{ separator($supervisi->real_nilai) }} </td>
                                </tr>


                            </table>
                        </div>
                        <div class="tab-pane" id="kurva">
                            <canvas id="line_target_real" style="width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>

            </div>
            <!-- /.box-body -->
            @if ($data->status_project != 'DROP')
                <div class="box-footer">
                    <div class="box-tools pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success">Action Supervisi</button>
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('ped-panel/form-baseline/' . $data->id) }}">Baseline Activity</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            @endif

        </div>
        <!-- /. box -->

    </div>
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Detail Project</h3>

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
                        <li><a href="#summary-rab" data-toggle="tab">RAB</a></li>
                        <li><a href="#total" data-toggle="tab">TOTAL</a></li>
                        <li><a href="#sap" data-toggle="tab" class="text-blue"><b> REPORT SAP </b></a></li>
                        <li><a href="#smilley" data-toggle="tab" class="text-blue"><b>SMILLEY </b></a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">
                            <table class="table table-striped">

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
                                    <td>RAB MATERIAL</td>
                                    <td> <b>{{ separator($data->rab_material) }} </b> </td>
                                </tr>
                                <tr>
                                    <td>RAB SURVEY</td>
                                    <td> <b>{{ separator($data->rab_survey) }} </b> </td>
                                </tr>

                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="total">
                            <table class="table table-striped">

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
                                    <td>RAB TOTAL</td>
                                    <td> <b>{{ separator($data->rab_total) }} </b> </td>
                                </tr>
                                <tr>
                                    <td>NILAI CAPEX PER PORT</td>
                                    <td> <b>{{ $data->nilai_capex_per_port }} </b> </td>
                                </tr>


                            </table>
                        </div>
                        <div class="tab-pane" id="sap">
                            <table class="table table-striped">
                                @if (!$sap)
                                    <td> Tidak ditemukan data SAP</td>
                                @else
                                    <tr>
                                        <td> baru co</td>
                                        <td> <b>{{ $sap->baru_co }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td> cfu</td>
                                        <td> <b>{{ $sap->cfu }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td>flag </td>
                                        <td> <b>{{ $sap->flag }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> uraian wbs</td>
                                        <td> <b>{{ $sap->uraian_wbs }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td>comm release </td>
                                        <td> <b>{{ $sap->comm_release }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> pay release</td>
                                        <td> <b>{{ $sap->pay_release }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> wbs element</td>
                                        <td> <b>{{ $sap->wbs_element }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> purchasing doc</td>
                                        <td> <b>{{ $sap->purchasing_doc }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> kontrak</td>
                                        <td> <b>{{ $sap->kontrak }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> proses</td>
                                        <td> <b>{{ $sap->proses }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> ref doc no</td>
                                        <td> <b>{{ $sap->ref_doc_no }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> item</td>
                                        <td> <b>{{ $sap->item }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> cost elem</td>
                                        <td> <b>{{ $sap->cost_elem }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> name</td>
                                        <td> <b>{{ $sap->name }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> ses pelimpahan</td>
                                        <td> <b>{{ $sap->ses_pelimpahan }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> witel</td>
                                        <td> <b>{{ $sap->witel }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td>id vendor </td>
                                        <td> <b>{{ $sap->id_vendor }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> vendor</td>
                                        <td> <b>{{ $sap->vendor }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> ta non ta</td>
                                        <td> <b>{{ $sap->ta_non_ta }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> user</td>
                                        <td> <b>{{ $sap->user }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td>doc date </td>
                                        <td> <b>{{ $sap->doc_date }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> nilai pr po gr</td>
                                        <td> <b>{{ $sap->nilai_pr_po_gr }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> value tcur</td>
                                        <td> <b>{{ $sap->value_tcur }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> status pr</td>
                                        <td> <b>{{ $sap->status_pr }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td> status po</td>
                                        <td> <b>{{ $sap->status_po }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td>status_gr </td>
                                        <td> <b>{{ $sap->status_gr }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td>debit date </td>
                                        <td> <b>{{ $sap->debit_date }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td>keterangan </td>
                                        <td> <b>{{ $sap->keterangan }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td>achv progi </td>
                                        <td> <b>{{ $sap->achv_progi }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td>tematik </td>
                                        <td> <b>{{ $sap->tematik }}</b> </td>
                                    </tr>

                                    <tr>
                                        <td>status sap </td>
                                        <td> <b>{{ $sap->status_sap }}</b> </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="tab-pane" id="smilley">
                            <table class="table table-striped">
                                @if (!$smilley)
                                    <td> Tidak ditemukan data smilley</td>
                                @else
                                    <tr>
                                        <td>kd kontrak </td>
                                        <td> <b>{{ $sap->kd_kontrak }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>no amdke </td>
                                        <td> <b>{{ $sap->no_amdke }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>kd wbs </td>
                                        <td> <b>{{ $sap->kd_wbs }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>kd sgrup </td>
                                        <td> <b>{{ $sap->kd_sgrup }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>pk owner </td>
                                        <td> <b>{{ $sap->pk_owner }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>kd lokasi1 </td>
                                        <td> <b>{{ $sap->kd_lokasi1 }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>ubis waslak </td>
                                        <td> <b>{{ $sap->ubis_waslak }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>unit waslak </td>
                                        <td> <b>{{ $sap->unit_waslak }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>waslak har </td>
                                        <td> <b>{{ $sap->waslak_har }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>ubis owner </td>
                                        <td> <b>{{ $sap->ubis_owner }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>no kontrak </td>
                                        <td> <b>{{ $sap->no_kontrak }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>nm proyek </td>
                                        <td> <b>{{ $sap->nm_proyek }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>tg edc </td>
                                        <td> <b>{{ $sap->tg_edc }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>tg toc </td>
                                        <td> <b>{{ $sap->tg_toc }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>nm tematik </td>
                                        <td> <b>{{ $sap->nm_tematik }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>nm witel </td>
                                        <td> <b>{{ $sap->nm_witel }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>nm lokasi1 </td>
                                        <td> <b>{{ $sap->nm_lokasi1 }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>project site id </td>
                                        <td> <b>{{ $sap->project_site_id }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>kt lokasi </td>
                                        <td> <b>{{ $sap->kt_lokasi }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>site alamat </td>
                                        <td> <b>{{ $sap->site_alamat }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>pro plan </td>
                                        <td> <b>{{ $sap->pro_plan }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>pro actual </td>
                                        <td> <b>{{ $sap->pro_actual }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>pro bast </td>
                                        <td> <b>{{ $sap->pro_bast }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>status </td>
                                        <td> <b>{{ $sap->status }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>tg plan start </td>
                                        <td> <b>{{ $sap->tg_plan_start }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>tg plan finish </td>
                                        <td> <b>{{ $sap->tg_plan_finish }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>tg actual start </td>
                                        <td> <b>{{ $sap->tg_actual_start }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>no ut </td>
                                        <td> <b>{{ $sap->no_ut }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>tg ut </td>
                                        <td> <b>{{ $sap->tg_ut }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>no bast1 </td>
                                        <td> <b>{{ $sap->no_bast1 }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>tg baut </td>
                                        <td> <b>{{ $sap->tg_baut }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>ni barang </td>
                                        <td> <b>{{ $sap->ni_barang }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>ni jasa </td>
                                        <td> <b>{{ $sap->ni_jasa }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>ni kontrak </td>
                                        <td> <b>{{ $sap->ni_kontrak }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>ni bast1 </td>
                                        <td> <b>{{ $sap->ni_bast1 }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>no po1 </td>
                                        <td> <b>{{ $sap->no_po1 }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>no po2 </td>
                                        <td> <b>{{ $sap->no_po2 }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>no po3 </td>
                                        <td> <b>{{ $sap->no_po3 }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>no po4 </td>
                                        <td> <b>{{ $sap->no_po4 }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>no po5 </td>
                                        <td> <b>{{ $sap->no_po5 }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>nm vendor </td>
                                        <td> <b>{{ $sap->nm_vendor }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>tg bast1 </td>
                                        <td> <b>{{ $sap->tg_bast1 }}</b> </td>
                                @endif
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
    {{-- <div class="col-md-3">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Menu</h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><i class="fa fa-circle-o text-red"></i> Baseline Project</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Planing Activity</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Actual Activity</a></li>
                </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="info-box bg-maroon">
            <span class="info-box-icon"><i class="fa fa-plane"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Progress Plan</span>
                <span class="info-box-number">
                    10 %

                </span>

                <div class="progress">
                    <div class="progress-bar" style="width: 10%"></div>
                </div>
                <span class="progress-description">
                    Total Durasi 10 Hari
                </span>
            </div>
        </div>

        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-check"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Progress Actual</span>
                <span class="info-box-number">
                    {{ isset($supervisi->progress_actual) ? $supervisi->progress_actual : 0 }} %
    </span>
    <div class="progress">
        <div class="progress-bar" style="width: {{ isset($supervisi->progress_actual) ? $supervisi->progress_actual : 0 }}%"></div>
    </div>
    <span class="progress-description">
        Total Durasi 0 Hari
    </span>
</div>
</div>

<div class="info-box bg-blue">
    <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>

    <div class="info-box-content">
        <span class="info-box-text">Progress Administrasi</span>
        <span class="info-box-number">

            0 %


        </span>
        <div class="progress">
            <div class="progress-bar" style="width: 0%"></div>
        </div>
    </div>
    <!-- /.info-box-content -->
</div>
</div> --}}


    <!-- /.col -->
</div>

<script>
    $(function() {

        var dateLabel = [],
            planData = [],
            actualData = []

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };

        async function dummyChart() {
            await getDummyData()

            var config = {
                type: 'line',
                data: {
                    labels: dateLabel,
                    datasets: [{
                            label: 'Bobot Plan',
                            backgroundColor: window.chartColors.red,
                            borderColor: window.chartColors.red,
                            data: planData,
                            fill: false,
                        },
                        {
                            label: 'Bobot Real',
                            backgroundColor: window.chartColors.green,
                            borderColor: window.chartColors.green,
                            data: actualData,
                            fill: false,
                        },

                    ]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Grafik Plan VS Grafik REAL'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        scaleShowValues: true,
                        xAxes: [{
                            ticks: {
                                autoSkip: true
                            }
                        }],

                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            }
                        }]
                    }
                }
            };

            var ctx = document.getElementById('line_target_real').getContext('2d');
            new Chart(ctx, config);
        }

        dummyChart()

        //Fetch Data from API

        async function getDummyData() {
            const apiUrl = "{{ url('/ped-panel/api/kurva_s/' . $supervisi->project_id) }}"

            const response = await fetch(apiUrl)
            const barChatData = await response.json()

            const actual = barChatData.data.map((x) => x.bobot_real)
            // console.log(salary)
            const plan = barChatData.data.map((x) => x.bobot_plan)
            const date = barChatData.data.map((x) => x.date)

            actualData = actual
            planData = plan
            dateLabel = date

        }

    });
</script>
