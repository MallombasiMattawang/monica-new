@extends('pengguna.layouts.app')

@section('page_header')
<div class="page-header pattern-bg">
    <div class="container-fluid">
        <div class="row">
            <div class=" mb-2">
                @include('pengguna.layouts.partials.breadcrumb')
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h2 mb-md-0 text-white fw-light">{{ $pageTitle }}</h1>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('contents')
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body border-bottom">
                        <div class="d-flex align-items-md-start align-items-center flex-column flex-md-row">

                            <div class="media-body m-0 mt-4 mt-md-0 text-md-start text-center">
                                <h4 class="mb-1 fw-light">Project Name: <strong>{{ $data->lop_site_id }}</strong> </h4>


                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs tab-card border-bottom-0 pt-2 fs-6 justify-content-center justify-content-md-start" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" data-bs-toggle="tab" href="#profile_post" role="tab" aria-selected="true"><span>Overview</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" href="#profile_groups" role="tab" aria-selected="false" tabindex="-1"><i class="fa fa-address-card-o"></i><span class="d-none d-sm-inline-block ms-2">Feeder</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" href="#profile_project" role="tab" aria-selected="false" tabindex="-1"><i class="fa fa-list-alt"></i><span class="d-none d-sm-inline-block ms-2">Distribusi</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" href="#profile_campaigns" role="tab" id="tab_profile_campaigns" aria-selected="false" tabindex="-1"><i class="fa fa-bookmark"></i><span class="d-none d-md-inline-block ms-2">ODP</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" href="#profile_activity" role="tab" aria-selected="false" tabindex="-1"><i class="fa fa-bookmark"></i><span class="d-none d-md-inline-block ms-2">ODC</span></a></li>
                    </ul>
                </div>
                <div class="tab-content mt-5">
                    <!-- Tab: Overview -->
                    <div class="tab-pane fade active show" id="profile_post" role="tabpanel">
                        <div class="row-title mb-2">
                            <h5>Project Overview</h5>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-body">                                        
                                        <table class="table align-middle card-table mb-0 myDataTable nowrap dataTable no-footer dtr-inline">
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
                               
                            </div>
                           
                        </div> <!-- Row end  -->
                    </div>
                    <!-- Tab: Groups -->
                    <div class="tab-pane fade" id="profile_groups" role="tabpanel">
                        <div class="row-title mb-2">
                            <h5>Feeder</h5>
                            
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-body">                                        
                                        <table class="table align-middle card-table mb-0 myDataTable nowrap dataTable no-footer dtr-inline">
                                            
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
                                </div>
                               
                            </div>
                        </div> <!-- Row end  -->
                        
                    </div>
                    <!-- Tab: Project -->
                    <div class="tab-pane fade" id="profile_project" role="tabpanel">
                        <div class="row-title mb-2">
                            <h5>Distribusi</h5>
                           
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-body">                                        
                                        <table class="table align-middle card-table mb-0 myDataTable nowrap dataTable no-footer dtr-inline">
                                            
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
                                </div>
                               
                            </div>
                        </div> <!-- Row end  -->
                    </div>
                    <!-- Tab: Campaigns -->
                    <div class="tab-pane fade" id="profile_campaigns" role="tabpanel" aria-labelledby="#tab_profile_campaigns">
                        <div class="row-title mb-2">
                            <h5>ODC</h5>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-body">                                        
                                        <table class="table align-middle card-table mb-0 myDataTable nowrap dataTable no-footer dtr-inline">
                                            
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
                                </div>
                               
                            </div>
                        </div> <!-- Row end  -->
                    </div>
                    <!-- Tab: Activity -->
                    <div class="tab-pane fade" id="profile_activity" role="tabpanel">
                        <div class="row-title mb-2">
                            <h5>ODP</h5>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-body">                                        
                                        <table class="table align-middle card-table mb-0 myDataTable nowrap dataTable no-footer dtr-inline">
                                            
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
                                </div>
                               
                            </div>
                        </div> <!-- Row end  -->
                    </div>
                </div>
              
            </div>
        </div> <!-- Row end  -->
    </div>
</div>
@endsection
