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
                            <h3 class="mb-0"> {{ (int) $progress_plan }} %</h3>
                            <small class="info">of 100%</small>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 2px;">
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {{ (int) $progress_plan }}%;"></div>
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
                            <h3 class="mb-0"> {{ $sum_selesai + $sum_belum }} %</h3>
                            <small class="info">of 100%</small>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 2px;">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {{ $sum_selesai + $sum_belum }}%;"></div>
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
                    @if ($list->activity_id == 3)
                    <tr class="bg-light ">
                        <td>
                            <b>[002] MATERIAL DELIVERY
                            </b>
                        </td>
                        <td colspan="15"> <b>30</b> </td>
                    </tr>
                    @endif
                    @if ($list->activity_id == 10)
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
                        <td class=" text-center">{{ $list->actual_start ? Round($list->actual_progress, 1) . '%' : '' }}</td>
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
                        <td class="text-center">
                            @if ($list->category_id == 001 || $list->category_id == 002)
                                 @if ($list->actual_status == 'belum' || $list->actual_task == null || $list->actual_task == 'REJECTED')
                                    <a href="{{ $list->actual_task == 'NEED APPROVED' ? '#' : route('supervisi.actual.form',  [$list->id, Str::slug($list->list_activity)])  }}" {{-- {{ $list->actual_task == 'NEED APPROVED' ? 'disabled' : '' }} --}} class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;
                                        Add Actual
                                    </a>
                                @else
                                    <a href="{{ route('supervisi.actual.log',  [$list->id, Str::slug($list->list_activity)])  }}" class="btn btn-info"><i class="fa fa-search"></i> </a>
                                @endif
                            @endif
                            @if ($list->category_id == 003)
                                @if ($list->actual_status == 'belum' || $list->actual_task == null || $list->actual_task == 'REJECTED')
                                     @if ($cek_all_delivery == $cek_all_delivery_finish && $list->activity_id < 20) 
                                        <a href="{{ route('supervisi.actual.form',  [$list->id, Str::slug($list->list_activity)])  }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                    @endif
                                    @if ($cek_all_installasi == $cek_all_installasi_finish && $list->activity_id == 20)
                                        <a href="{{ $list->actual_task == 'NEED APPROVED' ? '#' : route('supervisi.actual.form',  [$list->id, Str::slug($list->list_activity)])  }}" {{ $list->actual_task == 'NEED APPROVED' ? 'disabled' : '' }} class="btn btn-primary"><i class="fa fa-plus"></i>
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('supervisi.actual.log',  [$list->id, Str::slug($list->list_activity)])  }}" class="btn btn-info"><i class="fa fa-search"></i></a>
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
