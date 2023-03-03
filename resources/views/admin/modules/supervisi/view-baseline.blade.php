<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-tag"></i> WASPANG dan TIM UT</h3>
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
                    <form class="form-prevent" action="{{ url('ped-panel/update-baseline') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input type="hidden" class="form-control" name="project_id" value=" {{ $project->id }} ">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>WASPANG</label>
                                        <select class="form-control select2" name="waspang_id" required {{ $supervisi->task == 'PENENTUAN WASPANG DAN TIM UT' ? '' : 'disabled' }}>>
                                            <option value=""></option>
                                            @foreach ($waspang as $d)
                                            <option value="{{ $d->id }}" {{ $supervisi->waspang_id == $d->id ? 'selected' : '' }}>
                                               {{ $d->nik }} | {{ $d->name }}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>TIM UT</label>
                                        <select class="form-control select2" name="tim_ut_id" required {{ $supervisi->task == 'PENENTUAN WASPANG DAN TIM UT' ? '' : 'disabled' }}>
                                            <option value=""></option>
                                            @foreach ($tim_ut as $d)
                                            <option value="{{ $d->id }}" {{ $supervisi->tim_ut_id == $d->id ? 'selected' : '' }}>
                                                {{ $d->nik }} | {{ $d->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                            </div>
                            <hr>
                            @if ($supervisi->task == 'PENENTUAN WASPANG DAN TIM UT')
                            <div class="text-center">
                                <a href="javascript:void(0);" class="btn btn-default btn-lg container-refresh"><i class="fa fa-refresh"></i>
                                    Reload</a>
                                <button type="submit" class="btn btn-success btn-lg "><i class="fa fa-save"></i>
                                    Submit</button>
                            </div>
                            @endif

                        </div>
                    </form>

                </div>

            </div>
            <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-plane"></i> Project Summary
                </h3>
            
        </div>
        <div class="box-body">
            <table class="table">
                <tr>
                    <td width="200">LOP / SITE ID </td>
                    <td width="10">:</td>
                    <td>{{ $project->lop_site_id }}</td>
                </tr>
                <tr>
                    <td width="200">STATUS PROJECT</td>
                    <td>:</td>
                    <td>
                        {{ $project->status_project }}

                    </td>
                </tr>
                <tr>
                    <td width="200">WITEL </td>
                    <td>:</td>
                    <td>{{ $project->witel_id }}</td>
                </tr>
                <tr>
                    <td width="200">MITRA </td>
                    <td>:</td>
                    <td> <b>{{ $project->mitra_id }} </b> | <b>{{ $project->mitra->nama_mitra }} </b> </td>
                </tr>
               
                <tr>
                    <td width="200">NOMOR KONTRAK</td>
                    <td>:</td>
                    <td>{{ ($project->sap) ? $project->sap->kontrak : '-' }} </td>
                </tr>
                <tr>
                    <td width="200">STATUS SAP </td>
                    <td>:</td>
                    <td>{{ ($project->sap) ? $project->sap->status_sap : '-' }} </td>
                </tr>
                <tr>
                    <td width="200">START - FINISH PROJECT </td>
                    <td>:</td>
                    <td>{{ $project->start_date }} s.d {{ $project->end_date }}</td>
                </tr>

            </table>
        </div>
    </div>
        </div>
        <div class="col-md-12">

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Baseline</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th rowspan="2" class="text-center bg-gray disabled color-palette"> <br> List
                                    Activity </th>
                                <th colspan="3" class="text-center bg-yellow active color-palette">BASELINE PED
                                </th>
                            </tr>
                            <tr>
                                <th class="bg-yellow active color-palette text-center">Bobot</th>
                                <th class="bg-yellow active color-palette text-center">Volume</th>
                                <th class="bg-yellow active color-palette text-center">Satuan</th>
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
                            <tr class="bg-gray color-palette">
                                <td>
                                    <b>[001] PREPARING
                                    </b>
                                </td>
                                <td colspan="7"> <b>20</b> </td>
                            </tr>
                            @endif
                            @if ($list->activity_id == 3)
                            <tr class="bg-gray color-palette">
                                <td>
                                    <b>[002] MATERIAL DELIVERY
                                    </b>
                                </td>
                                <td colspan="7"> <b>30</b> </td>
                            </tr>
                            @endif
                            @if ($list->activity_id == 10)
                            <tr class="bg-gray color-palette">
                                <td>
                                    <b>[003] INSTALASI & TES COMM
                                    </b>
                                </td>
                                <td colspan="7"> <b>40</b> </td>
                            </tr>
                            @endif
                            @if ($list->activity_id == 21)
                            <tr class="bg-gray color-palette">
                                <td>
                                    <b>[004] CLOSING
                                    </b>
                                </td>
                                <td colspan="7"> <b>10</b> </td>
                            </tr>
                            @endif
                            <tr>
                                <td>
                                    {{ $list->list_activity }} {!! $category !!}

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" {{ $list->id }} ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" {{ $list->category_id }} ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" {{ $list->list_activity }} ">
                                </td>
                                @if ($supervisi->task == 'PENENTUAN WASPANG DAN TIM UT')
                                <td> <input type="number" class="form-control jumlah" name="bobot[]" value="{{ $list->bobot }}" readonly> </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ $list->volume }}" readonly> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" value="{{ $list->satuan }}" readonly> </td>
                                @else
                                <td class=""> {{ $list->bobot }}</td>
                                <td class="">{{ $list->volume }} </td>
                                <td class=""> {{ $list->satuan }} </td>
                                @endif
                            </tr>
                            @endforeach
                            @if ($supervisi->task == 'PENENTUAN WASPANG DAN TIM UT')
                            <tr>
                                <td>TOTAL BOBOT</td>

                                <td><input type="text" class="form-control" placeholder="Total" name="total_bobot" value="100" readonly></td>
                                <td></td>
                            </tr>
                            @endif

                        </table>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>


        </div>
    </div>


</section>
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
