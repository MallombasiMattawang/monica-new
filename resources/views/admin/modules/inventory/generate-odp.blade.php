<div class="col-md-6">

    <div class="box box-danger">
        <div class="box-header with-border">
            {{-- <h3 class="box-title">Generate ODP</h3> --}}

        </div>
        <form action="" method="get">
            <div class="box-body">

                <div class="row">

                    <div class="col-xs-6">
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
                    <div class="col-xs-3">
                        <label for="">Nomor awal ODP</label>
                        <input type="number" class="form-control" name="start" placeholder="1" required>
                    </div>
                    <div class="col-xs-3">
                        <label for="">Nomor Akhir ODP</label>
                        <input type="number" class="form-control" name="finish" placeholder="10" required>
                    </div>

                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-danger">Generate ODP Name</button>
                <a href="{{ url('ped-panel/tran-inventory/' . $supervisi->id . '/edit') }}"
                    class="btn btn-success pull-right"><i class="fa fa-edit"></i> UPDATE ODP STATUS</a>

            </div>
        </form>
        <!-- /.box-body -->
    </div><!-- /.box -->

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">ODP NUMBER</h3>
        </div>
        @if ($start >= 1)
            <form action="{{ url('ped-panel/generate-odp') }}" method="post">
                @csrf
                <input type="hidden" name="supervisi_id" value="{{ $supervisi->id }}">
                <input type="hidden" name="start" value="{{ $start }}">
                <input type="hidden" name="finish" value="{{ $finish }}">
                <div class="box-body" style="height: 550px; overflow-y: scroll;">
                    @for ($i = $start; $i <= $finish; $i++)
                        @php
                            $formatted_i = str_pad($i, 2, '0', STR_PAD_LEFT);
                            $cek_odp = App\Models\TranOdp::where('nama_odp', $kode_odp . '/' . $formatted_i)->exists();
                        @endphp
                        @if ($cek_odp == 0)
                            <div class="col-xs-9">
                                <label for="">Kode ODP </label>

                                <input type="text" class="form-control" name="kode_odp_in[]" placeholder="KODE ODP"
                                    value="{{ $kode_odp }}/{{ $formatted_i }}" required>
                            </div>

                            <div class="col-xs-3">
                                <label for="">JENIS ODP</label>
                                <select name="jenis_odp_in[]" class="form-control">
                                    <option value="ODP 8" selected>ODP 8</option>
                                    <option value="ODP 16">ODP 16</option>
                                </select>
                            </div>
                        @else
                            {{ $kode_odp }}/{{ $formatted_i }} Sudah ada,
                        @endif
                    @endfor


                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        @endif


        <!-- /.box-body -->
    </div><!-- /.box -->


</div>

<div class="col-md-6">

    <form action="" method="post">
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
                        <th>REAL GOLIVE</th>
                    </tr>

                    @forelse ($listOdp as $d)
                        <tr>
                            <td>{{ $d->nama_odp }}</td>
                            <td>{{ $d->jenis_odp }}</td>
                            <td>
                                <select class="form-control" style="width: 100%;" name="namaOdp[][status_go_live]"
                                    data-value="NO DATA">
                                    <option value=""></option>
                                    <option value="NO DATA" selected="">NO DATA</option>
                                    <option value="VALIDASI ABD">VALIDASI ABD</option>
                                    <option value="DRAWING">DRAWING</option>
                                    <option value="INVENTORY">INVENTORY</option>
                                    <option value="TERMINASI UIM">TERMINASI UIM</option>
                                    <option value="GOLIVE">GOLIVE</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="width: 100%;" name="namaOdp[][kendala]">
                                    <option value=""></option>
                                    <option value="Need Port OLT">Need Port OLT</option>
                                    <option value="Need Mini OLT">Need Mini OLT</option>
                                    <option value="Core Feeder Unspec">Core Feeder Unspec</option>
                                    <option value="Core Feeder Habis">Core Feeder Habis</option>
                                    <option value="Mancore Not Valid">Mancore Not Valid</option>
                                    <option value="Belum CT">Belum CT</option>
                                    <option value="Belum Valins">Belum Valins</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="width: 100%;" name="namaOdp[][status_abd]"
                                    data-value="NO ABD">
                                    <option value=""></option>
                                    <option value="NO ABD" selected="">NO ABD</option>
                                    <option value="TIDAK VALID">TIDAK VALID</option>
                                    <option value="VALID-4">VALID-4</option>
                                    <option value="BA VALID">BA VALID</option>
                                </select>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="real_golive">
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
                <button class="btn btn-success pull-right">Update status per-ODP</button>
            </div>
        </div><!-- /.box -->
    </form>

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Update Inventory</h3>
        </div>

        <div class="box-body" style="height: 400px; overflow-y: scroll;">
            <table class="table table-striped">
                <tr>
                    <td>STATUS GL SDI </td>
                    <td>
                        <select class="form-control" style="width: 100%;" name="namaOdp[][status_go_live]"
                            data-value="NO DATA">
                            <option value=""></option>
                            <option value="NO DATA" selected="">NO DATA</option>
                            <option value="VALIDASI ABD">VALIDASI ABD</option>
                            <option value="DRAWING">DRAWING</option>
                            <option value="INVENTORY">INVENTORY</option>
                            <option value="TERMINASI UIM">TERMINASI UIM</option>
                            <option value="GOLIVE">GOLIVE</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        KET GL SDI
                    </td>
                    <td>
                        <input type="text" class="form-control" name="ket_gl_sdi">
                    </td>
                </tr>
                <tr>
                    <td>STATUS ABD </td>
                    <td>
                        <select class="form-control" style="width: 100%;" name="namaOdp[][status_abd]"
                            data-value="NO ABD">
                            <option value=""></option>
                            <option value="NO ABD" selected="">NO ABD</option>
                            <option value="TIDAK VALID">TIDAK VALID</option>
                            <option value="VALID-4">VALID-4</option>
                            <option value="BA VALID">BA VALID</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>ID SW</td>
                    <td>
                        <input type="text" class="form-control" name="id_sw">
                    </td>
                </tr>
                <tr>
                    <td>ID IMON</td>
                    <td>
                        <input type="text" class="form-control" name="id_imon">
                    </td>
                </tr>
                <tr>
                    <td>PLAN GOLIVE</td>
                    <td>
                        <input type="text" class="form-control" name="plan_golive" value="{{ $supervisi->plan_golive }}">
                    </td>
                </tr>
                <tr>
                    <td>REAL GOLIVE</td>
                    <td>
                        <input type="text" class="form-control" name="real_golive" value="{{ $supervisi->real_golive }}" readonly>
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

            </table>
        </div>
        <div class="box-footer">

        </div>

        <!-- /.box-body -->
    </div><!-- /.box -->
</div>
