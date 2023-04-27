<section class="content">
    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-plane"></i> Project Summary
            </h3>
            <div class="box-tools pull-right">
                <a href="{{ url('/ped-panel/tran-supervisis', $supervisi->id) }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back </a>
            </div>
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
                    <td>{{ $project->mitra_id }} </td>
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

    <div id="add_delivery" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ url('ped-panel/add-delivery') }}">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <input type="hidden" name="category_id" value="002">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Actual Delivery</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama Actual Activity</label>
                            <input type="text" class="form-control" name="list_activity" placeholder="Enter Activity">
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" class="form-control" name="satuan" placeholder="Enter Satuan">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="add_instalasi" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ url('ped-panel/add-instalasi') }}">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <input type="hidden" name="category_id" value="003">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Actual Instalasi</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama Actual Activity</label>
                            <input type="text" class="form-control" name="list_activity" placeholder="Enter Activity">
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" class="form-control" name="satuan" placeholder="Enter Satuan">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-tag"></i> Baseline Activity</h3>
        </div>
        <div class="box-body">


            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-edit"></i> Task!</h4>
                {{ $supervisi->task }}
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="form-prevent" action="{{ url('ped-panel/create-baseline') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <input type="hidden" class="form-control" name="project_id" value=" {{ $project->id }} ">
                <div class="table-responsive">
                    <table id="nilai_bobot" class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="60%" rowspan="2" class="text-center bg-gray disabled color-palette"> <br>
                                    List
                                    Activity </th>

                                <th colspan="3" class="text-center bg-yellow active color-palette">BASELINE PED
                                </th>


                            </tr>
                            <tr>
                                <th class="bg-yellow active color-palette text-center">Bobot</th>
                                <th class="bg-yellow active color-palette text-center">Volume</th>
                                <th class="bg-yellow active color-palette text-center">Satuan</th>


                            </tr>
                            <tr>
                                <td>
                                    <b>[001] PREPARING
                                    </b>
                                </td>
                                <td class="text-center"> <b>20</b> </td>
                            </tr>
                            <tr>
                                <td>
                                    1.01. [008] Survey <span class="label label-default">Preparing</span>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 1 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 001 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 1.01. [008] Survey ">
                                </td>
                                <td> <input type="number" class="form-control jumlah" name="bobot[]" value="10" readonly> </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="1"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="LOP">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    1.02. [012] Design Review Meeting <span class="label label-default">Preparing</span>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 2 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 001 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 1.02. [012] Design Review Meeting ">
                                </td>
                                <td> <input type="number" class="form-control jumlah" name="bobot[]" value="10" readonly> </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="1"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="BA">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>[002] MATERIAL DELIVERY
                                    </b>
                                    <a id="add-delivery" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#add_delivery"> <i class="fa fa-plus"></i> Add Activity</a>
                                </td>
                                <td class="text-center"> <input type="text" id="total_material" class="form-control" placeholder="Total" name="total_material" readonly="">
                                </td>
                                <td colspan="2"><i class="text-red">(Pastikan total bobot "MATERIAL DELIVERY" =
                                        <b>30</b>)</i></td>
                            </tr>

                            <tr>
                                <td>
                                    2.01. [016] Delivery Material Sipil (MH/HH/Bridge/Pondasi) <span class="label label-warning">Material Delivery</span><a class="delete-row-btn btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 3 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 002 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 2.01. [016] Delivery Material Sipil (MH/HH/Bridge/Pondasi) ">
                                </td>
                                <td> <input type="number" class="form-control jumlah material" name="bobot[]" value="5">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ old('volume.2') }}" required>
                                </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="PC">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    2.02. [017] Delivery Duct/subduct/HDPE <span class="label label-warning">Material
                                        Delivery</span><a class="delete-row-btn btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 4 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 002 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 2.02. [017] Delivery Duct/subduct/HDPE ">
                                </td>
                                <td> <input type="number" class="form-control jumlah material" name="bobot[]" value="5">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ old('volume.3') }}" required>
                                </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="METER">
                                </td>
                            </tr>
                            @if ($deliveryKabel > 0)
                            @php
                            $c = 4;
                            @endphp
                            <tr>
                                <td>
                                    2.03. [018] Delivery Kabel <span class="label label-warning">Material
                                        Delivery</span><a class="delete-row-btn btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 5 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 002 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 2.03. [018] Delivery Kabel ">
                                </td>
                                <td> <input type="number" class="form-control jumlah material" name="bobot[]" value="5">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ $deliveryKabel }}"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="METER"> </td>
                            </tr>
                            @endif
                            @if ($deliveryTiang > 0)
                            @php
                            $c = 5;
                            @endphp
                            <tr>
                                <td>
                                    2.04. [019] Delivery Tiang <span class="label label-warning">Material
                                        Delivery</span><a class="delete-row-btn btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 6 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 002 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 2.04. [019] Delivery Tiang ">
                                </td>
                                <td> <input type="number" class="form-control jumlah material" name="bobot[]" value="5">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ $deliveryTiang }}"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="PCS">
                                </td>
                            </tr>
                            @endif
                            @if ($deliveryOdp > 0)
                            @php
                            $c = 6;
                            @endphp
                            <tr>
                                <td>
                                    2.05. [020] Delivery ODP <span class="label label-warning">Material
                                        Delivery</span>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 7 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 002 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 2.05. [020] Delivery ODP ">
                                </td>
                                <td> <input type="number" class="form-control jumlah material" name="bobot[]" value="5">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ $deliveryOdp }}"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="PCS">
                                </td>
                            </tr>
                            @endif
                            @if ($deliveryOdc > 0)
                            @php
                            $c = 7;
                            @endphp
                            <tr>
                                <td>
                                    2.06. [026] Delivery ODC <span class="label label-warning">Material
                                        Delivery</span>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 8 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 002 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 2.06. [026] Delivery ODC ">
                                </td>
                                <td> <input type="number" class="form-control jumlah material" name="bobot[]" value="3">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ $deliveryOdc }}"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="PCS">
                                </td>
                            </tr>
                            @endif
                            <tr>
                                @php
                                $c = $c + 1;
                                @endphp
                                <td>
                                    2.07. [027] Delivery Aksesoris <span class="label label-warning">Material
                                        Delivery</span><a class="delete-row-btn btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 9 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 002 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 2.07. [027] Delivery Aksesoris ">
                                </td>
                                <td> <input type="number" class="form-control jumlah material" name="bobot[]" value="2">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ old('volume.' . $c . '') }}" required>
                                </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="PCS">
                                </td>
                            </tr>
                            @foreach ($temp_baseline_delivery as $d)
                            <tr class="bg-gray">
                                @php
                                $c = $c + 1;
                                @endphp
                                <td>
                                    {{ $d->list_activity }}</span> <a class="delete-row-btn btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value="0">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 002 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value="{{ $d->list_activity }}">
                                </td>
                                <td> <input type="number" class="form-control jumlah material" name="bobot[]" value="2">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ old('volume.' . $c . '') }}" required>
                                </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value=" {{ $d->satuan }}">
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>
                                    <b>[003] INSTALASI & TEST COMM
                                    </b>
                                    <a id="add-instalasi" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#add_instalasi"> <i class="fa fa-plus"></i> Add Activity</a>
                                </td>
                                <td class="text-center"> <input type="text" id="total_install" class="form-control" placeholder="Total" name="total_install" readonly="">
                                </td>
                                <td colspan="2"><i class="text-red">(Pastikan total bobot "INSTALASI & TEST COMM"
                                        =
                                        <b>40</b>)</i></td>
                            </tr>

                            <tr>
                                <td>
                                    @php
                                    $c = $c + 1;
                                    @endphp
                                    3.01. [010] Perijinan Pihak Ketiga (PU/BTS/Warga/SITAC) <span class="label label-primary">Installasi &amp; Test Comm</span> <a class="delete-row-btn-install btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 10 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 003 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 3.01. [010] Perijinan Pihak Ketiga (PU/BTS/Warga/SITAC) ">
                                </td>
                                <td> <input type="number" class="form-control jumlah install" name="bobot[]" value="4">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ old('volume.' . $c . '') }}" required>
                                </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="DOKUMEN"> </td>
                            </tr>
                            <tr>
                                @php
                                $c = $c + 1;
                                @endphp
                                <td>
                                    3.02. [011] Pekerjaan Galian (Trenching/Rodding/Crossing/Borring) <span class="label label-primary">Installasi &amp; Test Comm</span> <a class="delete-row-btn-install btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 11 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 003 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 3.02. [011] Pekerjaan Galian (Trenching/Rodding/Crossing/Borring) ">
                                </td>
                                <td> <input type="number" class="form-control jumlah install" name="bobot[]" value="4">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ old('volume.' . $c . '') }}" required>
                                </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="METER">
                                </td>
                            </tr>
                            <tr>
                                @php
                                $c = $c + 1;
                                @endphp
                                <td>
                                    3.03. [013] Pekerjaan Sipil (HH/MH/Bridge/Pondasi) <span class="label label-primary">Installasi &amp; Test Comm</span> <a class="delete-row-btn-install btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 12 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 003 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 3.03. [013] Pekerjaan Sipil (HH/MH/Bridge/Pondasi) ">
                                </td>
                                <td> <input type="number" class="form-control jumlah install" name="bobot[]" value="4">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ old('volume.' . $c . '') }}" required>
                                </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="PCS">
                                </td>
                            </tr>
                            <tr>
                                @php
                                $c = $c + 1;
                                @endphp
                                <td>
                                    3.04. [014] Pekerjaan Duct/Subduct/HDPE <span class="label label-primary">Installasi &amp; Test Comm</span> <a class="delete-row-btn-install btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 13 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 003 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 3.04. [014] Pekerjaan Duct/Subduct/HDPE ">
                                </td>
                                <td> <input type="number" class="form-control jumlah install" name="bobot[]" value="4">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ old('volume.' . $c . '') }}" required>
                                </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="METER">
                                </td>
                            </tr>
                            @if ($deliveryTiang > 0)
                            <tr>
                                @php
                                $c = $c + 1;
                                @endphp
                                <td>
                                    3.05. [015] Penanaman Tiang <span class="label label-primary">Installasi &amp;
                                        Test
                                        Comm</span> <a class="delete-row-btn-install btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 14 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 003 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 3.05. [015] Penanaman Tiang ">
                                </td>
                                <td> <input type="number" class="form-control jumlah install" name="bobot[]" value="4">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ $deliveryTiang }}"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="PCS"> </td>
                            </tr>
                            @endif
                            @if ($penarikanFeeder > 0)
                            <tr>
                                @php
                                $c = $c + 1;
                                @endphp
                                <td>
                                    3.06. [021] Penarikan Kabel Feeder <span class="label label-primary">Installasi
                                        &amp; Test Comm</span> <a class="delete-row-btn-install btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 15 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 003 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 3.06. [021] Penarikan Kabel Feeder ">
                                </td>
                                <td> <input type="number" class="form-control jumlah install" name="bobot[]" value="4">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ $penarikanFeeder }}"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="METER"> </td>
                            </tr>
                            @endif
                            @if ($penarikanDist > 0)
                            <tr>
                                @php
                                $c = $c + 1;
                                @endphp
                                <td>
                                    3.07. [022] Penarikan Kabel Distribusi <span class="label label-primary">Installasi
                                        &amp; Test Comm</span> <a class="delete-row-btn-install btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 16 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 003 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 3.07. [022] Penarikan Kabel Distribusi ">
                                </td>
                                <td> <input type="number" class="form-control jumlah install" name="bobot[]" value="4">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ $penarikanDist }}"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="METER"> </td>
                            </tr>
                            @endif

                            @if ($deliveryOdc > 0)
                            <tr>
                                @php
                                $c = $c + 1;
                                @endphp
                                <td>
                                    3.08. [023] Pemasangan ODC <span class="label label-primary">Installasi &amp;
                                        Test
                                        Comm</span> <a class="delete-row-btn-install btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 17 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 003 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 3.08. [023] Pemasangan ODC ">
                                </td>
                                <td> <input type="number" class="form-control jumlah install" name="bobot[]" value="4">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ $deliveryOdc }}"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="PCS"> </td>
                            </tr>
                            @endif
                            @if ($deliveryOdp > 0)
                            <tr>
                                @php
                                $c = $c + 1;
                                @endphp
                                <td>
                                    3.09. [024] Pemasangan ODP <span class="label label-primary">Installasi &amp;
                                        Test
                                        Comm</span> <a class="delete-row-btn-install btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 18 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 003 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 3.09. [024] Pemasangan ODP ">
                                </td>
                                <td> <input type="number" class="form-control jumlah install" name="bobot[]" value="4">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ $deliveryOdp }}"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="PCS"> </td>
                            </tr>
                            @endif
                            @foreach ($temp_baseline_install as $d)
                            <tr class="bg-gray">
                                @php
                                $c = $c + 1;
                                @endphp
                                <td>
                                    {{ $d->list_activity }}</span> <a class="delete-row-btn-install btn btn-default">Delete</a>

                                    <input type="hidden" class="form-control" name="activity_id[]" value="0">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 003 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value="{{ $d->list_activity }}">
                                </td>
                                <td> <input type="number" class="form-control jumlah install" name="bobot[]" value="2">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ old('volume.' . $c . '') }}" required>
                                </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value=" {{ $d->satuan }}">
                                </td>
                            </tr>
                            @endforeach

                            <tr>
                                @php
                                $c = $c + 1;
                                @endphp
                                <td>
                                    3.10. [025] Jointing / Terminasi <span class="label label-primary">Installasi &amp;
                                        Test Comm</span>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 19 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 003 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 3.10. [025] Jointing / Terminasi ">
                                </td>
                                <td> <input type="number" class="form-control jumlah install" name="bobot[]" value="2">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="{{ old('volume.' . $c . '') }}" required>
                                </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="CORE">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    3.11. [028] Commisioning Test <span class="label label-primary">Installasi &amp;
                                        Test Comm</span>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 20 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 003 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 3.11. [028] Commisioning Test ">
                                </td>
                                <td> <input type="number" class="form-control jumlah install" name="bobot[]" value="2">
                                </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="1"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="LOP">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>[004] CLOSING
                                    </b>
                                </td>
                                <td class="text-center"> <b>10</b> </td>
                            </tr>
                            <tr>
                                <td>
                                    4.01. [005] Pelaksanaan UT <span class="label label-success">Clossing</span>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 21 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 004 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 4.01. [005] Pelaksanaan UT ">
                                </td>
                                <td> <input type="number" class="form-control jumlah " name="bobot[]" value="5" readonly> </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="1"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="LOP">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    4.02. [006] Rekonsiliasi <span class="label label-success">Clossing</span>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 22 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 004 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 4.02. [006] Rekonsiliasi ">
                                </td>
                                <td> <input type="number" class="form-control jumlah" name="bobot[]" value="3" readonly> </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="1"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="BA">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    4.02. [007] Penerbitan BAST-1 <span class="label label-success">Clossing</span>

                                    <input type="hidden" class="form-control" name="activity_id[]" value=" 23 ">
                                    <input type="hidden" class="form-control" name="category_id[]" value=" 004 ">
                                    <input type="hidden" class="form-control" name="list_activity[]" value=" 4.02. [007] Penerbitan BAST-1 ">
                                </td>
                                <td> <input type="number" class="form-control jumlah" name="bobot[]" value="2" readonly> </td>
                                <td> <input type="number" class="form-control" name="volume[]" value="1"> </td>
                                <td> <input type="text" class="form-control" name="satuan[]" readonly value="BA">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>TOTAL BOBOT
                                    </b>
                                </td>

                                <td><input type="text" id="total" class="form-control" placeholder="Total" name="total_bobot" readonly=""></td>
                                <td colspan="2"><i class="text-red">(Pastikan total bobot
                                        =
                                        <b>100</b>)</i></td>

                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <div class="text-center">
                        <a href="javascript:void(0);" class="btn btn-default btn-lg container-refresh"><i class="fa fa-refresh"></i>
                            Reload</a>
                        <button type="submit" class="btn btn-success btn-lg " id="submit-ku"><i class="fa fa-save"></i>
                            Submit</button>
                    </div>

                </div>

            </form>

        </div>

    </div>
</section>

@php
Admin::script('



');
@endphp
<script>
    // get all the delete buttons
    var deleteButtons = document.querySelectorAll('.delete-row-btn');
    var hitung = 0;
    var total = 0;


    // add click event listener to each delete button
    deleteButtons.forEach(function(button) {

        button.addEventListener('click', function() {
            var hitung = 0;
            var total = 0;

            var hitung_total = 0;
            var total_total = 0;
            $('.form-prevent').find('.jumlah').each(function() {
                hitung_total++;
                total_total = total_total + parseInt($(this).val());
            });
            $("#total").val(total_total);

            $('.form-prevent').find('.material').each(function() {
                hitung++;
                total = total + parseInt($(this).val());
            });
            $("#total_material").val(total);
            // get the row to be deleted
            var row = this.parentNode.parentNode;

            // remove the row from the table
            row.parentNode.removeChild(row);
            var hitung = 0;
            var total = 0;

            var hitung_total = 0;
            var total_total = 0;
            $('.form-prevent').find('.jumlah').each(function() {
                hitung_total++;
                total_total = total_total + parseInt($(this).val());
            });
            $("#total").val(total_total);

            $('.form-prevent').find('.material').each(function() {
                hitung++;
                total = total + parseInt($(this).val());
            });
            $("#total_material").val(total);

        });

    });

</script>

<script>
    // get all the delete buttons
    var deleteButtons = document.querySelectorAll('.delete-row-btn-install');
    var hitung = 0;
    var total = 0;


    // add click event listener to each delete button
    deleteButtons.forEach(function(button) {

        button.addEventListener('click', function() {
            var hitung = 0;
            var total = 0;

            var hitung_total = 0;
            var total_total = 0;
            $('.form-prevent').find('.jumlah').each(function() {
                hitung_total++;
                total_total = total_total + parseInt($(this).val());
            });
            $("#total").val(total_total);

            $('.form-prevent').find('.install').each(function() {
                hitung++;
                total = total + parseInt($(this).val());
            });
            $("#total_install").val(total);
            // get the row to be deleted
            var row = this.parentNode.parentNode;

            // remove the row from the table
            row.parentNode.removeChild(row);
            var hitung = 0;
            var total = 0;

            var hitung_total = 0;
            var total_total = 0;
            $('.form-prevent').find('.jumlah').each(function() {
                hitung_total++;
                total_total = total_total + parseInt($(this).val());
            });
            $("#total").val(total_total);

            $('.form-prevent').find('.install').each(function() {
                hitung++;
                total = total + parseInt($(this).val());
            });
            $("#total_install").val(total);

        });

    });

</script>

<script>
    $(document).ready(function() {
        var hitung = 0;
        var total = 0;

        $('.form-prevent').find('.material').each(function() {
            hitung++;
            total = total + parseInt($(this).val());
        });

        $("#total_material").val(total);
        $(".material").change(function() {
            var hitung = 0;
            var total = 0;
            $('.form-prevent').find('.material').each(function() {
                hitung++;
                total = total + parseInt($(this).val());
            });
            $("#total_material").val(total);
        })
    });

</script>

<script>
    $(document).ready(function() {
        var hitung = 0;
        var total = 0;

        $('.form-prevent').find('.install').each(function() {
            hitung++;
            total = total + parseInt($(this).val());
        });

        $("#total_install").val(total);
        $(".install").change(function() {
            var hitung = 0;
            var total = 0;
            $('.form-prevent').find('.install').each(function() {
                hitung++;
                total = total + parseInt($(this).val());
            });
            $("#total_install").val(total);
        })
    });

</script>


<script>
    $(document).ready(function() {
        var hitung = 0;
        var total = 0;

        $('.form-prevent').find('.jumlah').each(function() {
            hitung++;
            total = total + parseInt($(this).val());
        });

        $("#total").val(total);
        $(".jumlah").change(function() {
            var hitung = 0;
            var total = 0;
            $('.form-prevent').find('.jumlah').each(function() {
                hitung++;
                total = total + parseInt($(this).val());
            });
            $("#total").val(total);
        })
    });

</script>
<script>
    $(document).ready(function() {
        var checkTextarea = (e) => {
            const content = $("#my-textarea").val().trim();
            $('#submit-ku').prop('disabled', content === '');
        };

        $(document).on('keyup', '#my-textarea', checkTextarea);
    });

</script>
