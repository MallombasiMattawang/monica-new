<div class="col-12">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between text-danger">
                        <div>
                            <h5 class="mb-0">Progress Plan</h5>

                        </div>
                        <div class="text-end">
                            <h3 class="mb-0"> {{ getProgressPlan($supervisi->project_id, $supervisi->supervisi_project->start_date) }} %</h3>
                            <small class="info">of 100%</small>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 2px;">
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {{ (int) getProgressPlan($supervisi->project_id, $supervisi->supervisi_project->start_date) }}%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between text-success">
                        <div>
                            <h5 class="mb-0">Progress Actual</h5>

                        </div>
                        <div class="text-end">
                            <h3 class="mb-0"> {{ getProgressActual($supervisi->project_id, $supervisi->supervisi_project->start_date) }} %</h3>
                            <small class="info">of 100%</small>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 2px;">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {{ getProgressActual($supervisi->project_id, $supervisi->supervisi_project->start_date) }}%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                        <th rowspan="2" class="text-center bg-light-info">
                            ACTION
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
                    @if ($list->activity_id == 1)
                    <tr class="bg-light">
                        <td>
                            <b>[001] PREPARING
                            </b>
                        </td>
                        <td colspan="15"> <b>20</b> </td>
                    </tr>
                    @endif
                    @if ($list->activity_id == $minActivityDelivery)
                    <tr class="bg-light ">
                        <td>
                            <b>[002] MATERIAL DELIVERY
                            </b>
                        </td>
                        <td colspan="15"> <b>30</b> </td>
                    </tr>
                    @endif
                    @if ($list->activity_id == $minActivityInstalasi)
                    <tr class="bg-light ">
                        <td>
                            <b>[003] INSTALASI & TES COMM
                            </b>
                        </td>
                        <td colspan="15"> <b>40</b> </td>
                    </tr>
                    @endif
                    @if ($list->activity_id == 21)
                    <tr class="bg-light ">
                        <td>
                            <b>[004] CLOSING
                            </b>
                        </td>
                        <td colspan="15"> <b>10</b> </td>
                    </tr>
                    @endif
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
                                <span class="badge bg-success {{ $list->pending_item == 'YA' && activeGuard() == 'mitra' ? 'd-none' :''  }}">{{ $list->actual_task }}</span>
                            @elseif ($list->actual_task == 'NEED APPROVED')
                                <span class="badge bg-info">{{ $list->actual_task }}</span>
                            @elseif ($list->actual_task == 'NEED UPDATED')
                                <span class="badge bg-warning">{{ $list->actual_task }}</span>
                            @else
                                <span class="badge bg-danger">{{ $list->actual_task }}</span>
                            @endif
                            @if (($list->pending_item == 'YA' && $list->activity_id == 20 && activeGuard() == 'mitra') && ($list->actual_task != 'NEED APPROVED WASPANG'))
                                <div class="btn bg-light-info">
                                    Selesaikan Pending Item untuk lanjut ke Actual selanjutnya
                                </div>
                            @endif
                            @if (($list->pending_item == 'YA' && $list->activity_id == 21 && activeGuard() == 'mitra') && ($list->actual_task != 'NEED APPROVED TIM UT'))
                            <div class="btn bg-light-info">
                                Selesaikan Pending Item untuk lanjut ke Actual selanjutnya
                            </div>
                        @endif
                        </td>
                        @if ($supervisi->supervisi_project->status_plan == 1)
                        <td class="text-center">
                            @if ($list->category_id == 001 || $list->category_id == 002)
                                 @if ($list->actual_status == 'belum' || $list->actual_task == null || $list->actual_task == 'REJECTED' && activeGuard() == 'mitra')
                                    <a href="{{ route('supervisi.actual.form',  [$list->id, Str::slug($list->list_activity)])  }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                @else
                                    <a href="{{ route('supervisi.actual.log',  [$list->id, Str::slug($list->list_activity)])  }}" class="btn btn-info"><i class="fa fa-search"></i> </a>
                                @endif
                            @endif
                            @if ($list->category_id == 003)
                            {{-- {{ $cek_all_installasi }} dan {{ $cek_all_installasi_finish }} --}}
                                @if ($list->actual_status == 'belum' || $list->actual_task == null || $list->actual_task == 'REJECTED' && activeGuard() == 'mitra')
                                     @if ($cek_all_delivery == $cek_all_delivery_finish && $list->activity_id < 20)
                                        <a href="{{ route('supervisi.actual.form',  [$list->id, Str::slug($list->list_activity)])  }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                    @endif
                                    @if ($cek_all_installasi == $cek_all_installasi_finish && $list->activity_id == 20 && activeGuard() == 'mitra')
                                        <a href="{{ route('supervisi.actual.form',  [$list->id, Str::slug($list->list_activity)])  }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                        </a>
                                    @endif
                                @elseif ($list->actual_task != null && $list->actual_task != 'NEED APPROVED WASPANG')
                                    @if ($list->pending_item == 'YA' && $list->activity_id == 20 && activeGuard() == 'mitra')
                                        <a href="{{ route('supervisi.actual.log',  [$list->id, Str::slug($list->list_activity)])  }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>

                                    @else
                                    <a href="{{ route('supervisi.actual.log',  [$list->id, Str::slug($list->list_activity)])  }}" class="btn btn-info"><i class="fa fa-search"></i></a>
                                    @endif

                                @endif

                                @if (activeGuard() == 'waspang')
                                        @if (cekWaspangAdmin($list->project_id) == 1 && $list->activity_id == 20)
                                            <a href="{{ route('supervisi.actual.log',  [$list->id, Str::slug($list->list_activity)])  }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        @endif
                                @endif
                             @endif
                             @if ($list->category_id == 004)

                                @if (($list->actual_status == 'belum' || $list->actual_task == null || $list->actual_task == 'REJECTED') && (activeGuard() == 'mitra'))
                                    @if ($cek_commisioning_tes == 1 && $list->activity_id == 21 && pendingItemCT($list->project_id) == 0)
                                        <a href="{{ route('supervisi.actual.form',  [$list->id, Str::slug($list->list_activity)])  }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                    @endif
                                    @if ($cek_ut == 1 && $list->activity_id == 22 && pendingItemUT($list->project_id) == 0)
                                        <div class="btn bg-light-info">
                                            Lanjutkan di menu Administration Activity
                                        </div>
                                    @endif
                                @elseif ($list->actual_task != null && $list->actual_task != 'NEED APPROVED TIM UT')
                                    @if ($list->pending_item == 'YA' && $list->activity_id == 21 && activeGuard() == 'mitra')
                                        <a href="{{ route('supervisi.actual.log',  [$list->id, Str::slug($list->list_activity)])  }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>

                                    @else
                                        <a href="{{ route('supervisi.actual.log',  [$list->id, Str::slug($list->list_activity)])  }}" class="btn btn-info"><i class="fa fa-search"></i></a>
                                    @endif
                                @endif
                                @if (activeGuard() == 'tim-ut')
                                    @if (cekUtAdmin($list->project_id) == 1 && $list->activity_id == 21)
                                        <a href="{{ route('supervisi.actual.log',  [$list->id, Str::slug($list->list_activity)])  }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    @endif
                                @endif

                                @if ($cek_rekon == 1 && $list->activity_id == 23)
                                    @if ($list->actual_finish == null || $list->actual_finish == '')
                                        <div class="btn bg-light-info">
                                            Tanggal penerbitan BAST-1 belum terbit pada smilley, tapi jika sudah BAST, silahkan upload Evident BAST-1
                                        </div>
                                    <br>
                                    <a href="{{ route('supervisi.actual.form',  [$list->id, Str::slug($list->list_activity)])  }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                    @endif

                                @endif
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
