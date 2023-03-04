<div class="col-12">
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="mb-0">Actual Activity</h5>

                </div>
                <div class="text-end">
                    <h3 class="mb-0"> {{ $sum_selesai + $sum_belum }} %</h3>
                    <small class="info">of 100%</small>
                </div>
            </div>
            <div class="progress mt-3" style="height: 2px;">
                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {{ (int) $supervisi->progress_actual }}%;"></div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="myDataTable table table-hover align-middle mb-0 nowrap dataTable no-footer dtr-inline collapsed">
                    <tr>
                        <th width="16%" rowspan="2" class="text-center bg-light disabled color-palette"> <br> List
                            Activity </th>
                        <th width="16%" colspan="3" class="text-center bg-light-warning active color-palette">BASELINE
                        </th>

                        <th width="16%" colspan="3" class="text-center bg-light-info active color-palette">
                            PROGRESS
                            ACTUAL
                        </th>
                        <th width="16%" colspan="3" class="text-center bg-light-success active color-palette">
                            ACTUAL
                        </th>
                        <th width="16%" rowspan="2" class="text-center bg-light-info active color-palette">
                            ACTION ACTUAL
                        </th>


                    </tr>
                    <tr>

                        <th class="bg-light-warning active color-palette text-center">Bobot</th>
                        <th class="bg-light-warning active color-palette text-center">Volume Kontrak</th>
                        <th class="bg-light-warning active color-palette text-center">Satuan</th>


                        <th class="bg-light-info active color-palette text-center"> Volume</th>
                        <th class="bg-light-info active color-palette text-center"> Progress</th>
                        <th class="bg-light-info active color-palette text-center"> Durasi</th>

                        <th class="bg-light-success active color-palette text-center"> Start</th>
                        <th class="bg-light-success active color-palette text-center"> Finish</th>
                        <th class="bg-light-success active color-palette text-center"> Status Update</th>


                    </tr>
                    @php
                    $n = 0;
                    @endphp
                    @foreach ($lists as $list)
                    @php
                    $n++;
                    if ($list->category_id == 001) {
                    $category = '<span class="label label-default">Preparing</span>';
                    } elseif ($list->category_id == 002) {
                    $category = '<span class="label label-warning">Material Delivery</span>';
                    } elseif ($list->category_id == 003) {
                    $category = '<span class="label label-primary">Installasi & Test Comm</span>';
                    } else {
                    $category = '<span class="label label-success">Clossing</span>';
                    }
                    @endphp
                    @if ($list->activity_id == 1)
                    <tr class="bg-light color-palette">
                        <td>
                            <b>[001] PREPARING
                            </b>
                        </td>
                        <td colspan="15"> <b>20</b> </td>
                    </tr>
                    @endif
                    @if ($list->activity_id == 3)
                    <tr class="bg-light color-palette">
                        <td>
                            <b>[002] MATERIAL DELIVERY
                            </b>
                        </td>
                        <td colspan="15"> <b>30</b> </td>
                    </tr>
                    @endif
                    @if ($list->activity_id == 10)
                    <tr class="bg-light color-palette">
                        <td>
                            <b>[003] INSTALASI & TES COMM
                            </b>
                        </td>
                        <td colspan="15"> <b>40</b> </td>
                    </tr>
                    @endif
                    @if ($list->activity_id == 21)
                    <tr class="bg-light color-palette">
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



                        <td class="text-center"> {{ $list->actual_start ? $list->actual_volume : '' }}
                        </td>
                        <td class=" text-center">
                            {{ $list->actual_start ? Round($list->actual_progress, 1) . '%' : '' }}
                        </td>
                        <td class="text-center"> {{ $list->actual_durasi }} </td>

                        <td class="text-center">
                            {{ $list->actual_start ? date('d F Y', strtotime($list->actual_start)) : '' }}
                        </td>
                        <td class="text-center">
                            {{ $list->actual_finish ? date('d F Y', strtotime($list->actual_finish)) : '' }}
                        </td>
                        <td class="text-center">
                            @if ($list->actual_task == 'APPROVED')
                            <span class="label label-success">{{ $list->actual_task }}</span>
                            @elseif ($list->actual_task == 'NEED APPROVED')
                            <span class="label label-info">{{ $list->actual_task }}</span>
                            @elseif ($list->actual_task == 'NEED UPDATED')
                            <span class="label label-warning">{{ $list->actual_task }}</span>
                            @else
                            <span class="label label-danger">{{ $list->actual_task }}</span>
                            @endif
                            
                        </td>


                        <td class="text-center">
                            
                            @if ($list->category_id == 001 || $list->category_id == 002)
                            @if ($list->actual_status == 'belum' || $list->actual_task == null || $list->actual_task == 'REJECTED')
                            <a href="{{ $list->actual_task == 'NEED APPROVED' ? '#' : route('supervisi.actual.form',  [$list->id, Str::slug($list->list_activity)])  }}" {{-- {{ $list->actual_task == 'NEED APPROVED' ? 'disabled' : '' }} --}} class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;
                                Add Actual
                            </a>
                            @else
                            <a href="{{ url('ped-panel/log-generate?log=' . $list->id) }}" class="btn btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;

                            </a>
                           
                            @endif
                            {{-- @if ($list->category_id == 002)
                                                @if ($list->actual_status == 'belum' || $list->actual_task == null || $list->actual_task == 'REJECTED')
                                                    @if ($cek_last_preparing->actual_finish)
                                                        <a href="{{ $list->actual_task == 'NEED APPROVED' ? '#' : route('supervisi.actual.form',  [$list->id, Str::slug($list->list_activity)])  }}" {{ $list->actual_task == 'NEED APPROVED' ? 'disabled'  : '' }}
                            class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;
                            Add Actual
                            </a>
                            @endif
                            @else
                            <a href="{{ url('ped-panel/log-generate?log=' . $list->id) }}" class="btn btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;

                            </a>
                            @endif
                            @endif --}}
                            @if ($list->category_id == 003)
                            @if ($list->actual_status == 'belum' || $list->actual_task == null || $list->actual_task == 'REJECTED')
                            @if ($cek_all_delivery == $cek_all_delivery_finish && $list->activity_id < 20) <a href="{{ $list->actual_task == 'NEED APPROVED' ? '#' : route('supervisi.actual.form',  [$list->id, Str::slug($list->list_activity)])  }}" {{ $list->actual_task == 'NEED APPROVED' ? 'disabled' : '' }} class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;
                                Add Actual
                                </a>
                                @endif
                                @if ($cek_all_installasi == $cek_all_installasi_finish && $list->activity_id == 20)
                                <a href="{{ $list->actual_task == 'NEED APPROVED' ? '#' : route('supervisi.actual.form',  [$list->id, Str::slug($list->list_activity)])  }}" {{ $list->actual_task == 'NEED APPROVED' ? 'disabled' : '' }} class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;
                                    Add Actual
                                </a>
                                @endif
                                @else
                                <a href="{{ url('ped-panel/log-generate?log=' . $list->id) }}" class="btn btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;

                                </a>
                                @endif
                                @endif
                                @if ($list->category_id == 004)
                                @if ($list->actual_status == 'belum' || $list->actual_task == null || $list->actual_task == 'REJECTED')
                                @if ($cek_commisioning_tes == 1 && $list->activity_id == 21)
                                <a href="{{ $list->actual_task == 'NEED APPROVED' ? '#' : route('supervisi.actual.form',  [$list->id, Str::slug($list->list_activity)])  }}" {{ $list->actual_task == 'NEED APPROVED' ? 'disabled' : '' }} class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;
                                    Add Actual
                                </a>
                                @endif
                                @if ($cek_ut == 1 && $list->activity_id == 22)
                                <a href="{{ url('ped-panel/administrasi-generate?id=' . $list->project_id) }}" class="btn btn-warning"><i class="fa fa-file-o"></i>&nbsp;&nbsp;
                                    Administration Activity
                                </a>
                                @endif
                                @if ($cek_rekon == 1 && $list->activity_id == 23)
                                <a href="{{ url('ped-panel/administrasi-generate?id=' . $list->project_id) }}" class="btn btn-warning"><i class="fa fa-file-o"></i>&nbsp;&nbsp;
                                    Administration Activity
                                </a>
                                @endif
                                @else
                                <a href="{{ url('ped-panel/log-generate?log=' . $list->id) }}" class="btn btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;

                                </a>
                                @endif
                                @endif
                                @endif
                                @if (Admin::user()->inRoles(['waspang', 'administrator', 'hd-ped']))
                                @php
                                $log = App\Models\LogActual::where('tran_baseline_id', $list->id)
                                ->whereNull('approval_waspang')
                                ->count();
                                @endphp
                                @if ($log > 0 && $list->activity_id < 21) <a href="{{ url('ped-panel/add-approve?id=' . $list->id) }}" class="btn btn-app bg-light-success">
                                    <span class="badge bg-light-warning">{{ $log }}</span>
                                    <i class="fa fa-check">
                                    </i>&nbsp;&nbsp;
                                    Approval </a>
                                    @endif
                                    @endif
                                    @if (Admin::user()->inRoles(['tim-ut', 'administrator', 'hd-ped']))
                                    @php
                                    $log = App\Models\LogActual::where('tran_baseline_id', $list->id)
                                    ->whereNull('approval_tim_ut')
                                    ->count();
                                    @endphp
                                    @if ($list->actual_task == 'NEED APPROVED' && $list->activity_id == 21)
                                    <a href="{{ url('ped-panel/add-approve?id=' . $list->id) }}" class="btn btn-app bg-light-success">
                                        <span class="badge bg-light-warning">{{ $log }}</span>
                                        <i class="fa fa-check"></i>&nbsp;&nbsp;
                                        Approval UT</a>
                                    @endif
                                    @endif
                                    @if (Admin::user()->inRoles(['administrator', 'hd-ped']))
                                    @if ($list->actual_task == 'APPROVED' || $list->actual_task == 'REJECTED')
                                    <a href="{{ url('ped-panel/log-generate?log=' . $list->id) }}" class="btn btn-info"><i class="fa fa-search"></i>&nbsp;&nbsp;
                                    </a>
                                    @endif
                                    @endif

                        </td>



                    </tr>
                    @endforeach

                </table>
            </div>

        </div>
    </div>
</div>
