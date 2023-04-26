<section class="content">

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">

                <div class="box-body">
                    <table class="table">
                        <tr>
                            <td width="200">LOP / SITE ID </td>
                            <td width="10">:</td>
                            <td>{{ $project->lop_site_id }}</td>
                        </tr>

                        <tr>
                            <td width="200">WITEL </td>
                            <td>:</td>
                            <td>{{ $project->witel_id }}</td>
                        </tr>
                        <tr>
                            <td width="200">MITRA </td>
                            <td>:</td>
                            <td>{{ $project->mitra_id }} </td>
                        </tr>
                        {{-- <tr>
                            <td width="200">NDE PELIMPAHAN </td>
                            <td>:</td>
                            <td>{{ $project->nde_pelimpahan }} </td>
                        </tr> --}}

                        <tr>
                            <td width="200">NOMOR KONTRAK</td>
                            <td>:</td>
                            <td>{{ $project->sap ? $project->sap->kontrak : '-'}} </td>
                        </tr>
                        <tr>
                            <td width="200">STATUS SAP </td>
                            <td>:</td>
                            <td>{{ $project->sap ? $project->sap->status_sap : '-' }} </td>
                        </tr>
                        <tr>
                            <td width="200">START - FINISH PROJECT </td>
                            <td>:</td>
                            <td>{{ date('d F Y', strtotime($project->start_date)) }} s.d
                                {{ date('d F Y', strtotime($project->end_date)) }}</td>
                        </tr>
                        <tr>
                            <td width="200">WASPANG </td>
                            <td>:</td>
                            <td>{{ $supervisi->supervisi_waspang ? $supervisi->supervisi_waspang->name : '-' }} </td>
                        </tr>
                        <tr>
                            <td width="200">TIM UT </td>
                            <td>:</td>
                            <td>{{ $supervisi->supervisi_tim_ut ? $supervisi->supervisi_tim_ut->name : '-' }}</td>
                        </tr>


                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box bg-maroon">
                <span class="info-box-icon"><i class="fa fa-plane"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Progress Plan</span>
                    <span class="info-box-number">

                        {{ getProgressPlan($supervisi->project_id, $supervisi->supervisi_project->start_date) }} %

                    </span>

                    <div class="progress">
                        <div class="progress-bar" style="width: {{ getProgressPlan($supervisi->project_id, $supervisi->supervisi_project->start_date) }}%"></div>
                    </div>
                    <span class="progress-description">
                        {{-- Total Durasi {{ $progress_plan }} Hari --}}
                    </span>
                </div>

            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Progress Actual</span>
                    <span class="info-box-number">

                        {{ getProgressActual($supervisi->project_id, $supervisi->supervisi_project->start_date) }} %
                    </span>
                    <div class="progress">
                        <div class="progress-bar" style="width: {{ getProgressActual($supervisi->project_id, $supervisi->supervisi_project->start_date) }}%"></div>
                    </div>
                    <span class="progress-description">
                        {{-- Selesai : {{ $sum_selesai }} | Belum : {{ $sum_belum }} --}}
                    </span>
                </div>

            </div>
        </div>
        

    </div>



    <div class="row"></div>
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Baseline Activity</a></li>
            <li><a href="#tab_2" data-toggle="tab">Kurva S</a></li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-tag"></i> Baseline Activity</h3>
                    </div>
                    <div class="box-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="table-responsive">

                            <table class="myDataTable table table-hover">
                                <tr>
                                    <th rowspan="2" class="text-center bg-default disabled "> List
                                        Activity </th>
                                    <th colspan="3" class="text-center bg-warning">BASELINE
                                    </th>
            
                                    <th colspan="3" class="text-center bg-info">
                                        PROGRESS
                                        ACTUAL
                                    </th>
                                    <th colspan="3" class="text-center bg-success">
                                        ACTUAL
                                    </th>
                                    <th rowspan="2" class="text-center bg-info" style="width:100px">
                                        ACTION
                                    </th>
                                </tr>
                                <tr>
                                    <th class="bg-warning text-center">Bobot</th>
                                    <th class="bg-warning text-center">Volume</th>
                                    <th class="bg-warning text-center">Satuan</th>
                                    <th class="bg-info text-center"> Volume</th>
                                    <th class="bg-info text-center"> Progress</th>
                                    <th class="bg-info text-center"> Durasi</th>
                                    <th class="bg-success text-center"> Start</th>
                                    <th class="bg-success text-center"> Finish</th>
                                    <th class="bg-success text-center"> Status</th>
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
                                    @if ($supervisi->supervisi_project->status_plan == 1)
                                    <td class="text-center">
                                        @if ($list->category_id == 001 || $list->category_id == 002)
                                            @if ($list->actual_task != null)
                                                <a href="{{ url('ped-panel/log-generate/' . $list->id) }}"
                                                    class="btn btn-info"><i
                                                        class="fa fa-search"></i>&nbsp;&nbsp;
                                                </a>  
                                            @endif                                        
                                        @endif
                                        @if ($list->category_id == 003)
                                            @if ($list->actual_task != null && $list->actual_task != 'NEED APPROVED WASPANG')
                                                <a href="{{ url('ped-panel/log-generate/' . $list->id) }}"
                                                    class="btn btn-info"><i
                                                        class="fa fa-search"></i>&nbsp;&nbsp;
                                                </a>  
                                            @endif
                                             @if (cekWaspangAdmin($list->project_id) == 1 && $list->activity_id == 20)
                                                 <a href="{{ url('ped-panel/log-generate/' . $list->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                         @endif
                                         @if ($list->category_id == 004)                                                
                                         @if ($list->actual_task != null && $list->actual_task != 'NEED APPROVED TIM UT')
                                                <a href="{{ url('ped-panel/log-generate/' . $list->id) }}"
                                                    class="btn btn-info"><i
                                                        class="fa fa-search"></i>&nbsp;&nbsp;
                                                </a>  
                                            @endif
                                            @if (cekUtadmin($list->project_id) == 1 && $list->activity_id == 21)
                                                <a href="{{ url('ped-panel/log-generate/' . $list->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i>Approve</a>
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
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                <canvas id="line_target_real" style="width: 100%;"></canvas>
            </div><!-- /.tab-pane -->

        </div><!-- /.tab-content -->
    </div><!-- nav-tabs-custom -->

</section>

<div class="modal fade" id="submit_plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ url('ped-panel/plan-submit') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $project->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Submit Plan Project</h5>
                </div>
                <div class="modal-body">

                    @if ((int) $progress_plan == 100)
                        <div class="alert alert-success alert-dismissible">
                            <h4><i class="icon fa fa-info"></i> Info!</h4>
                            Pengisian Plan activity sudah mencapai 100%, anda bisa submit plan ini dan memulai
                            pengerjaan project sembari mengisi Actual Activity
                        </div>
                    @else
                        <div class="alert alert-danger alert-dismissible">
                            <h4><i class="icon fa fa-info"></i> Info!</h4>
                            Pengisian Plan activity belum 100%, silahkan isi semua Plan Start dan Plan Finish
                        </div>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if ((int) $progress_plan == 100)
                        <button type="submit" class="btn btn-primary">Submit Plan</button>
                    @endif

                </div>
            </div>
        </form>
    </div>
</div>
{{-- @php
Admin::style('.table {
            #background: #ee99a0;
            border-radius: 0.2rem;
            width: 100%;
            padding-bottom: 1rem;
            color: #212529;
            margin-bottom: 0;
          }
          .table th:nth-child(1),
          .table td:nth-child(1) {
            white-space: nowrap;
            position: sticky;
            left: 0;
            background-color: #ffffd5;
            color: #373737;
          }
         
          
          .table td {
            text-transform: uppercase;
            white-space: nowrap;
            background-color: #ffffd5;
          }');
@endphp --}}
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()


    })
</script>
<script>
    $(document).ready(function() {
        var hitung = 0;
        var total = 0;

        $('.form-prevent').find('.jumlah').each(function() {
            //if($(this).is(':checked'))
            //{
            hitung++;
            total = total + parseInt($(this).val());
            //}
        });


        //var jumlah = $(".jumlah").val();

        //var total = parseInt(jumlah);
        $("#total").val(total);

        $(".jumlah").change(function() {
            var hitung = 0;
            var total = 0;
            $('.form-prevent').find('.jumlah').each(function() {
                //if($(this).is(':checked'))
                //{
                hitung++;
                total = total + parseInt($(this).val());
                //}
            });
            //var jumlah = $(".jumlah").val();

            //var total = parseInt(jumlah);
            $("#total").val(total);
        })
    });
</script>
<script>
    $(function() {

        var dateLabel = []
            , planData = []
            , actualData = []

        window.chartColors = {
            red: 'rgb(255, 99, 132)'
            , orange: 'rgb(255, 159, 64)'
            , yellow: 'rgb(255, 205, 86)'
            , green: 'rgb(75, 192, 192)'
            , blue: 'rgb(54, 162, 235)'
            , purple: 'rgb(153, 102, 255)'
            , grey: 'rgb(201, 203, 207)'
        };

        async function dummyChart() {
            await getDummyData()

            var config = {
                type: 'line'
                , data: {
                    labels: dateLabel
                    , datasets: [{
                            label: 'Bobot Plan'
                            , backgroundColor: window.chartColors.red
                            , borderColor: window.chartColors.red
                            , data: planData
                            , fill: false
                        , }
                        , {
                            label: 'Bobot Real'
                            , backgroundColor: window.chartColors.green
                            , borderColor: window.chartColors.green
                            , data: actualData
                            , fill: false
                        , },

                    ]
                }
                , options: {
                    responsive: true
                    , title: {
                        display: true
                        , text: 'Grafik Plan VS Grafik REAL'
                    }
                    , tooltips: {
                        mode: 'index'
                        , intersect: true
                    , }
                    , hover: {
                        mode: 'nearest'
                        , intersect: true
                    }
                    , scales: {
                        scaleShowValues: true
                        , xAxes: [{
                            ticks: {
                                autoSkip: true
                            }
                        }],

                        yAxes: [{
                            display: true
                            , scaleLabel: {
                                display: true
                                , labelString: 'Value'
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
            const apiUrl = "{{ url('/supervisi/kurva_s/' . $list->project_id) }}"

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
