<div class="col-md-12">

    <div class="box box-danger">
        <div class="box-header with-border">
            {{-- <h3 class="box-title">Generate ODP</h3> --}}

        </div>
        <form action="" method="get">
            <div class="box-body">

                <div class="row">

                    <div class="col-xs-4">
                        <label for="">Kode ODP (Contoh : ODP-MAT-FBS)</label>
                        @php
                            $string = $supervisi->supervisi_project->catuan_nama;

                            if (!empty($string) && strpos($string, 'ODC') !== false) {
                                $string = str_replace('ODC', 'ODP', $string);
                            }
                        @endphp
                        <input type="text" class="form-control" name="kode_odp" placeholder="ODP-MAT-FBS"
                            value="{{ $string }}" required>
                    </div>
                    <div class="col-xs-2">
                        <label for="">Nomor awal ODP</label>
                        <input type="number" class="form-control" name="start" placeholder="1" required>
                    </div>
                    <div class="col-xs-2">
                        <label for="">Nomor Akhir ODP</label>
                        <input type="number" class="form-control" name="finish" placeholder="10" required>
                    </div>
                    <div class="col-xs-2">
                        <label for="">ID SW</label>
                        <input type="text" class="form-control" name="id_sw" placeholder="#ID SW" required>
                    </div>
                    <div class="col-xs-2">
                        <label for="">ID IMON</label>
                        <input type="text" class="form-control" name="id_imon" placeholder="#ID IMON" required>
                    </div>

                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-danger">Generate ODP Name</button>


            </div>
        </form>
        <!-- /.box-body -->
    </div><!-- /.box -->

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">GENERATE ODP NUMBER</h3>
        </div>
        @if ($start >= 1)
            <form action="{{ url('ped-panel/generate-odp') }}" method="post">
                @csrf
                <input type="hidden" name="supervisi_id" value="{{ $supervisi->id }}">
                <input type="hidden" name="start" value="{{ $start }}">
                <input type="hidden" name="finish" value="{{ $finish }}">
                <div class="box-body" style="height: 350px; overflow-y: scroll;">
                    @for ($i = $start; $i <= $finish; $i++)
                        @php
                            $formatted_i = str_pad($i, 2, '0', STR_PAD_LEFT);
                            $cek_odp = App\Models\TranOdp::where('nama_odp', $kode_odp . '/' . $formatted_i)->exists();
                        @endphp
                        @if ($cek_odp == 0)
                            <div class="col-xs-6">
                                <label for="">Kode ODP </label>

                                <input type="text" class="form-control" name="kode_odp_in[]" placeholder="KODE ODP"
                                    value="{{ $kode_odp }}/{{ $formatted_i }}" required>
                            </div>

                            <div class="col-xs-2">
                                <label for="">JENIS ODP</label>
                                <select name="jenis_odp_in[]" class="form-control">
                                    <option value="ODP 8" selected>ODP 8</option>
                                    <option value="ODP 16">ODP 16</option>
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <label for="">ID SW</label>
                                <input type="text" class="form-control" name="id_sw[]" value="{{ $_GET['id_sw'] }}">
                            </div>
                            <div class="col-xs-2">
                                <label for="">ID IMON</label>
                                <input type="text" class="form-control" name="id_imon[]"
                                    value="{{ $_GET['id_imon'] }}">
                            </div>
                        @else
                            {{ $kode_odp }}/{{ $formatted_i }} Sudah ada,
                        @endif
                    @endfor


                </div>
                <div class="box-footer">
                    <a href="{{ url('ped-panel/tran-inventory/' . $supervisi->id) }}" class="btn btn-default">Clear</a>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
            </form>
        @endif


        <!-- /.box-body -->
    </div><!-- /.box -->


</div>

<div class="col-md-12">

    <form action="{{ url('ped-panel/update-odp') }}" method="post">
        @csrf
        <input type="hidden" name="supervisi_id" value="{{ $supervisi->id }}">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">List ODP Terdaftar </h3>
            </div>
            <div class="box-body bg-primary" style="height: 400px; overflow-y: scroll;">

                <table class="table table-bordered">
                    <tr>
                        <th>Nama ODP</th>
                        <th>Jenis ODP</th>
                        <th>STATUS GOLIVE</th>
                        <th>KENDALA</th>
                        <th>STATUS ABD</th>
                        <th>ID SW</th>
                        <th>ID IMON</th>
                        <th>PLAN GOLIVE</th>
                        <th>REAL GOLIVE</th>
                    </tr>

                    @forelse ($listOdp as $d)
                        <input type="hidden" name="odp_id[]" value="{{ $d->id }}">
                        <tr>
                            <td>{{ $d->nama_odp }}</td>
                            <td>
                                <select class="form-control" style="width: 100%;" name="jenis_odp[]">
                                    <option value="ODP 8" {{ $d->jenis_odp == 'ODP 8' ? 'SELECTED' : '' }}>ODP 8
                                    </option>
                                    <option value="ODP 16" {{ $d->jenis_odp == 'ODP 16' ? 'SELECTED' : '' }}>ODP 16
                                    </option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="width: 100%;" name="status_go_live[]"
                                    data-value="NO DATA">
                                    <option value="NO DATA" {{ $d->status_go_live == 'NO DATA' ? 'SELECTED' : '' }}>NO
                                        DATA</option>
                                    <option value="VALIDASI ABD"
                                        {{ $d->status_go_live == 'VALIDASI ABD' ? 'SELECTED' : '' }}>VALIDASI ABD
                                    </option>
                                    <option value="DRAWING" {{ $d->status_go_live == 'DRAWING' ? 'SELECTED' : '' }}>
                                        DRAWING</option>
                                    <option value="INVENTORY"
                                        {{ $d->status_go_live == 'INVENTORY' ? 'SELECTED' : '' }}>INVENTORY</option>
                                    <option value="TERMINASI UIM"
                                        {{ $d->status_go_live == 'TERMINASI UIM' ? 'SELECTED' : '' }}>TERMINASI UIM
                                    </option>
                                    <option value="GOLIVE" {{ $d->status_go_live == 'GOLIVE' ? 'SELECTED' : '' }}>
                                        GOLIVE</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="width: 100%;" name="kendala[]">
                                    <option value=""></option>
                                    <option value="Need Port OLT"
                                        {{ $d->kendala == 'Need Port OLT' ? 'SELECTED' : '' }}>Need Port OLT</option>
                                    <option value="Need Mini OLT"
                                        {{ $d->kendala == 'Need Mini OLT' ? 'SELECTED' : '' }}>Need Mini OLT</option>
                                    <option value="Core Feeder Unspec"
                                        {{ $d->kendala == 'Core Feeder Unspec' ? 'SELECTED' : '' }}>Core Feeder Unspec
                                    </option>
                                    <option value="Core Feeder Habis"
                                        {{ $d->kendala == 'Core Feeder Habis' ? 'SELECTED' : '' }}>Core Feeder Habis
                                    </option>
                                    <option value="Mancore Not Valid"
                                        {{ $d->kendala == 'Mancore Not Valid' ? 'SELECTED' : '' }}>Mancore Not Valid
                                    </option>
                                    <option value="Belum CT" {{ $d->kendala == 'Belum CT' ? 'SELECTED' : '' }}>Belum
                                        CT
                                    </option>
                                    <option value="Belum Valins"
                                        {{ $d->kendala == 'Belum Valins' ? 'SELECTED' : '' }}>
                                        Belum Valins</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="width: 100%;" name="status_abd[]"
                                    data-value="NO ABD">
                                    <option value=""></option>
                                    <option value="NO ABD" {{ $d->status_abd == 'NO ABD' ? 'SELECTED' : '' }}>NO ABD
                                    </option>
                                    <option value="TIDAK VALID"
                                        {{ $d->status_abd == 'TIDAK VALID' ? 'SELECTED' : '' }}>TIDAK VALID</option>
                                    <option value="VALID-4" {{ $d->status_abd == 'VALID-4' ? 'SELECTED' : '' }}>
                                        VALID-4</option>
                                    <option value="BA VALID" {{ $d->status_abd == 'BA VALID' ? 'SELECTED' : '' }}>BA
                                        VALID</option>
                                </select>
                            </td>

                            <td>
                                <input type="text" class="form-control" name="id_sw[]"
                                    value="{{ $d->id_sw }}">
                            </td>

                            <td>
                                <input type="text" class="form-control" name="id_imon[]"
                                    value="{{ $d->id_imon }}">
                            </td>
                            <td>
                                <input type="date" class="form-control" name="plan_golive[]"
                                    value="{{ $supervisi->plan_golive }}">
                            </td>
                            <td>
                                <input type="date" class="form-control" name="real_golive[]"
                                    value="{{ $d->real_golive }}">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2"> ODP Masih Kosong </td>
                        </tr>
                    @endforelse
                </table>


            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-success">Update status per-ODP</button>
            </div>
        </div><!-- /.box -->
    </form>
    {{-- <form action="{{ url('ped-panel/update-inventory') }}" method="post">
        @csrf
        <input type="hidden" name="supervisi_id" value="{{ $supervisi->id }}">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Update Inventory</h3>
            </div>

            <div class="box-body" style="height: 500px; overflow-y: scroll;">
                <table class="table table-striped">
                    <tr>
                        <td>STATUS GL SDI </td>
                        <td>
                            <select class="form-control" style="width: 100%;" name="status_gl_sdi"
                                data-value="NO DATA">
                                <option value="NO DATA"
                                    {{ $supervisi->status_gl_sdi == 'NO DATA' ? 'SELECTED' : '' }}>NO DATA</option>
                                <option value="VALIDASI ABD"
                                    {{ $supervisi->status_gl_sdi == 'VALIDASI ABD' ? 'SELECTED' : '' }}>VALIDASI ABD
                                </option>
                                <option value="DRAWING"
                                    {{ $supervisi->status_gl_sdi == 'DRAWING' ? 'SELECTED' : '' }}>DRAWING</option>
                                <option value="INVENTORY"
                                    {{ $supervisi->status_gl_sdi == 'INVENTORY' ? 'SELECTED' : '' }}>INVENTORY</option>
                                <option value="TERMINASI UIM"
                                    {{ $supervisi->status_gl_sdi == 'TERMINASI UIM' ? 'SELECTED' : '' }}>TERMINASI UIM
                                </option>
                                <option value="GOLIVE" {{ $supervisi->status_gl_sdi == 'GOLIVE' ? 'SELECTED' : '' }}>
                                    GOLIVE</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            KET GL SDI
                        </td>
                        <td>
                            <input type="text" class="form-control" name="ket_gl_sdi"
                                value="{{ $supervisi->ket_gl_sdi }}">
                        </td>
                    </tr>
                    <tr>
                        <td>STATUS ABD </td>
                        <td>
                            <select class="form-control" style="width: 100%;" name="status_abd" data-value="NO ABD">
                                <option value="NO ABD" {{ $supervisi->status_abd == 'NO ABD' ? 'SELECTED' : '' }}>NO
                                    ABD</option>
                                <option value="TIDAK VALID"
                                    {{ $supervisi->status_abd == 'TIDAK VALID' ? 'SELECTED' : '' }}>TIDAK VALID
                                </option>
                                <option value="VALID-4" {{ $supervisi->status_abd == 'VALID-4' ? 'SELECTED' : '' }}>
                                    VALID-4</option>
                                <option value="BA VALID" {{ $supervisi->status_abd == 'BA VALID' ? 'SELECTED' : '' }}>
                                    BA VALID</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>KENDALA</td>
                        <td>
                            <select class="form-control" style="width: 100%;" name="kendala_sdi">
                                <option value=""></option>
                                <option value="Need Port OLT"
                                    {{ $supervisi->kendala == 'Need Port OLT' ? 'SELECTED' : '' }}>Need Port OLT
                                </option>
                                <option value="Need Mini OLT"
                                    {{ $supervisi->kendala == 'Need Mini OLT' ? 'SELECTED' : '' }}>Need Mini OLT
                                </option>
                                <option value="Core Feeder Unspec"
                                    {{ $supervisi->kendala == 'Core Feeder Unspec' ? 'SELECTED' : '' }}>Core Feeder
                                    Unspec</option>
                                <option value="Core Feeder Habis"
                                    {{ $supervisi->kendala == 'Core Feeder Habis' ? 'SELECTED' : '' }}>Core Feeder
                                    Habis</option>
                                <option value="Mancore Not Valid"
                                    {{ $supervisi->kendala == 'Mancore Not Valid' ? 'SELECTED' : '' }}>Mancore Not
                                    Valid</option>
                                <option value="Belum CT" {{ $supervisi->kendala == 'Belum CT' ? 'SELECTED' : '' }}>
                                    Belum CT</option>
                                <option value="Belum Valins"
                                    {{ $supervisi->kendala == 'Belum Valins' ? 'SELECTED' : '' }}>Belum Valins</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>ID SW</td>
                        <td>
                            <input type="text" class="form-control" name="id_sw"
                                value="{{ $supervisi->id_sw }}">
                        </td>
                    </tr>
                    <tr>
                        <td>ID IMON</td>
                        <td>
                            <input type="text" class="form-control" name="id_imon"
                                value="{{ $supervisi->id_imon }}">
                        </td>
                    </tr>
                    <tr>
                        <td>PLAN GOLIVE</td>
                        <td>
                            <input type="date" class="form-control" name="plan_golive"
                                value="{{ $supervisi->plan_golive }}">
                        </td>
                    </tr>
                    <tr>
                        <td>REAL GOLIVE</td>
                        <td>
                            <input type="text" class="form-control" name="real_golive"
                                value="{{ $supervisi->real_golive }}" readonly>
                        </td>
                    </tr>

                    {{-- <tr>
                        <td>PROJECT NAME</td>
                        <td> {{ $supervisi->supervisi_project->lop_site_id }} </td>
                    </tr>
                    <tr>
                        <td>Catuan Nama</td>
                        <td> {{ $supervisi->supervisi_project->catuan_nama }} </td>
                    </tr>
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
                            <td> {{ $supervisi->nama_odp }}  </td>
                        </tr> --}}
                    {{-- <tr>
                        <td>Plan GOLIVE</td>
                        <td> {{ $supervisi->plan_golive }} </td>
                    </tr>
                    <tr>
                        <td>Real GOLIVE</td>
                        <td> {{ $supervisi->real_golive }} </td>
                    </tr> --}}

                {{-- </table>
            </div>
            <div class="box-footer">
                <button class="btn btn-success pull-right"> Update Inventory</button>
            </div>

            <!-- /.box-body -->
        </div><!-- /.box --> --}}
    {{-- </form> --}}

</div>
