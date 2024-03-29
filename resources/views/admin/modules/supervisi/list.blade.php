<div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ url('ped-panel/list-supervisis') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari berdasarkan Project Name" value="{{ $search }}">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('ped-panel.admin.export.supervisi') }}" target="_blank" class="btn btn-primary"><i
                            class="fa fa-file-excel-o"></i> Eksports</a>
                </div>
            </div>
            <hr>
            <div class="box box-border">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="text-transform: uppercase;">
                                <tr>
                                    <th>id</th>
                                    <th>tematik</th>
                                    <th>witel</th>
                                    <th>sto</th>
                                    <th>project name</th>
                                    <th>mitra</th>
                                    <th>no sp telkom</th>
                                    <th>edc</th>
                                    <th>toc</th>
                                    <th>nilai kontrak</th>
                                    <th>nilai bast1</th>
                                    <th>plan port</th>
                                    <th>real port</th>
                                    <th>plan homepass</th>
                                    <th>real homepass</th>
                                    <th>name waspang</th>
                                    <th>name tim ut</th>
                                    <th>status const app</th>
                                    <th>status const sap</th>
                                    <th>remarks</th>
                                    <th>kendala</th>
                                    <th>tgl MOS</th>
                                    <th>plan Install Done</th>
                                    <th>tgl Install Done</th>
                                    <th>plan Selesai CT</th>
                                    <th>tgl Selesai CT</th>
                                    <th>plan Selesai UT</th>
                                    <th>tgl Selesai UT</th>
                                    <th>tgl Selesai Rekon</th>
                                    <th>tgl BAST1</th>
                                    <th>Durasi Install</th>
                                    <th>Durasi CT</th>
                                    <th>Durasi UT</th>
                                    <th>Durasi Closing</th>
                                    <th>Flaging Mitra</th>
                                    <th>Progres Fisik</th>
                                    <th>Status GOLIVE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $end_today = date('Y-m-d'); //end dihari ini
                                @endphp
                                @foreach ($supervisis as $d)
                                    @php
                                        $project = App\Models\MstProject::where('id', $d->project_id)->first();

                                        $tgl_mos = App\Models\TranBaseline::where('project_id', $d->project_id)
                                            ->whereNotNull('actual_finish')
                                            ->where('actual_finish', '<>', '')
                                            //->whereBetween('activity_id', [3, 9])
                                            ->where('category_id', 'like', '%002%')
                                            ->orderBy('actual_finish', 'desc')
                                            ->first();
                                        $plan_install_done = App\Models\TranBaseline::where('project_id', $d->project_id)
                                            ->whereNotNull('plan_finish')
                                            ->where('plan_finish', '<>', '')
                                            ->where('category_id', 'like', '%003%')
                                            ->where('activity_id', '!=', 20)
                                            ->orderBy('actual_finish', 'desc')
                                            ->first();
                                        $tgl_install_done = App\Models\TranBaseline::where('project_id', $d->project_id)
                                            ->whereNotNull('actual_finish')
                                            ->where('actual_finish', '<>', '')
                                            //->whereBetween('activity_id', [10, 19])
                                            ->where('category_id', 'like', '%003%')
                                            ->where('activity_id', '!=', 20)
                                            ->orderBy('actual_finish', 'desc')
                                            ->first();
                                        $plan_selesai_ct = App\Models\TranBaseline::where('project_id', $d->project_id)
                                            ->whereNotNull('plan_finish')
                                            ->where('plan_finish', '<>', '')
                                            ->where('activity_id', 20)
                                            ->first();
                                        $tgl_selesai_ct = App\Models\TranBaseline::where('project_id', $d->project_id)
                                            ->whereNotNull('actual_finish')
                                            ->where('actual_finish', '<>', '')
                                            ->where('activity_id', 20)
                                            ->first();
                                        $tgl_selesai_ut = App\Models\TranBaseline::where('project_id', $d->project_id)
                                            ->whereNotNull('actual_finish')
                                            ->where('actual_finish', '<>', '')
                                            ->where('activity_id', 21)
                                            ->first();
                                        $plan_selesai_ut = App\Models\TranBaseline::where('project_id', $d->project_id)
                                            ->whereNotNull('plan_finish')
                                            ->where('plan_finish', '<>', '')
                                            ->where('activity_id', 21)
                                            ->first();
                                        $tgl_selesai_rekon = App\Models\TranBaseline::where('project_id', $d->project_id)
                                            ->whereNotNull('actual_finish')
                                            ->where('actual_finish', '<>', '')
                                            ->where('activity_id', 22)
                                            ->first();
                                        $tgl_bast1 = App\Models\TranBaseline::where('project_id', $d->project_id)
                                            ->whereNotNull('actual_finish')
                                            ->where('actual_finish', '<>', '')
                                            ->where('activity_id', 23)
                                            ->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $d->id }}</td>
                                        <td>{{ $d->tematik }}</td>
                                        <td>{{ $d->witel }}</td>
                                        <td>{{ $d->sto }}</td>
                                        <td>{{ $d->project_name }}</td>
                                        <td>{{ $d->mitra }}</td>
                                        <td>{{ $d->no_sp_telkom }}</td>
                                        <td>{{ $d->edc }}</td>
                                        <td>{{ $d->toc }}</td>
                                        <td>{{ $d->nilai_kontrak }}</td>
                                        <td>
                                            @if ($d->status_const_app == 'BAST-1')
                                                {{ $d->nilai_bast1_smilley ? $d->nilai_bast1_smilley : $d->nilai_bast1_sap }}
                                            @endif

                                        </td>
                                        <td>{{ $d->plan_port }}</td>
                                        <td>
                                            @php
                                                $real_port = App\Models\TranOdp::where('supervisi_id', $d->id)
                                                    ->where('status_go_live', 'GOLIVE')
                                                    ->exists();
                                            @endphp
                                            @if ($real_port == 1)
                                                {{ $d->real_port }}
                                            @endif
                                        </td>
                                        <td>{{ $d->plan_homepass }}</td>
                                        <td>{{ $d->real_homepass }}</td>
                                        <td>{{ $d->name_waspang }}</td>
                                        <td>{{ $d->name_tim_ut }}</td>
                                        <td>{{ $d->status_const_app }}</td>
                                        <td>{{ $d->status_const_sap }}</td>
                                        <td>
                                            <button class="btn btn-default" data-toggle="modal"
                                                data-target="#modal-remark" data-project_id="{{ $d->project_id }}">View
                                                Remarks</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-default" data-toggle="modal"
                                                data-target="#modal-kendala"
                                                data-project_id="{{ $d->project_id }}">View
                                                Kendala</button>
                                        </td>
                                        <td>
                                            {{ isset($tgl_mos->actual_finish) && cek_all_delivery($d->project_id) == cek_all_delivery_finish($d->project_id) ? tgl_indo($tgl_mos->actual_finish) : '-' }}
                                        </td>
                                        <td>
                                            {{ isset($plan_install_done->plan_finish) ? tgl_indo($plan_install_done->plan_finish) : '-' }}
                                        </td>
                                        <td>
                                            {{ isset($tgl_install_done->actual_finish) && cek_all_installasi($d->project_id) == cek_all_installasi_finish($d->project_id) ? tgl_indo($tgl_install_done->actual_finish) : '-' }}
                                        </td>
                                        <td>
                                            {{ isset($plan_selesai_ct->plan_finish) ? tgl_indo($plan_selesai_ct->plan_finish) : '-' }}
                                        </td>
                                        <td>
                                            {{ isset($tgl_selesai_ct->actual_finish) ? tgl_indo($tgl_selesai_ct->actual_finish) : '-' }}
                                        </td>
                                        <td>
                                            {{ isset($plan_selesai_ut->plan_finish) ? tgl_indo($plan_selesai_ut->plan_finish) : '-' }}
                                        </td>
                                        <td>
                                            {{ isset($tgl_selesai_ut->actual_finish) ? tgl_indo($tgl_selesai_ut->actual_finish) : '-' }}
                                        </td>
                                        <td>
                                            {{ isset($tgl_selesai_rekon->actual_finish) ? tgl_indo($tgl_selesai_rekon->actual_finish) : '-' }}
                                        </td>
                                        <td>
                                            {{ isset($tgl_bast1->actual_finish) ? tgl_indo($tgl_bast1->actual_finish) : '-' }}
                                        </td>
                                        <td>
                                            {{ isset($tgl_install_done->actual_finish) && cek_all_installasi($d->project_id) == cek_all_installasi_finish($d->project_id) ? selisih_hari($tgl_mos->actual_finish, $tgl_install_done->actual_finish) : '-' }}
                                        </td>
                                        <td>
                                            {{ isset($tgl_selesai_ct->actual_finish) ? selisih_hari($tgl_install_done->actual_finish, $tgl_selesai_ct->actual_finish) : '-' }}
                                        </td>
                                        <td>
                                            {{ isset($tgl_selesai_ut->actual_finish) ? selisih_hari($tgl_selesai_ct->actual_finish, $tgl_selesai_ut->actual_finish) : '-' }}
                                        </td>
                                        <td>
                                            {{ isset($tgl_selesai_rekon->actual_finish) ? selisih_hari($tgl_selesai_ut->actual_finish, $tgl_selesai_rekon->actual_finish) : '-' }}
                                        </td>
                                        <td>{{ $d->flaging_mitra }}</td>
                                        <td>
                                            @if ($d->status_const_app == 'PREPARING' || $d->status_const_app == 'MATERIAL DELIVERY')
                                                PREPARE
                                            @elseif ($d->status_const_app == 'INSTALASI')
                                                INSTALASI
                                            @elseif (
                                                $d->status_const_app == 'INSTALL DONE' ||
                                                    $d->status_const_app == 'SELESAI CT' ||
                                                    $d->status_const_app == 'SELESAI UT' ||
                                                    $d->status_const_app == 'INSTALL DONE' ||
                                                    $d->status_const_app == 'BAST-1')
                                                FISIK DONE
                                            @endif
                                        </td>
                                        <td>
                                            @if ($real_port == 1)
                                                GOLIVE
                                            @else
                                                NY
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {{ $supervisis->links('vendor.pagination.default') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal-remark" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Konten modal -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Remarks</h4>
            </div>
            <div class="modal-body">
                <!-- Konten modal disini -->
                <div id="modalContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-kendala" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Konten modal -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Kendala</h4>
            </div>
            <div class="modal-body">
                <!-- Konten modal disini -->
                <div id="modalContentKendala"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modal-remark').on('show.bs.modal', function(e) {
            // Mendapatkan nilai ID dari tombol modal
            var project_id = $(e.relatedTarget).data('project_id');

            // Menampilkan nilai ID di dalam modal
            $('#modalId').text(project_id);
            // Melakukan permintaan AJAX untuk query berdasarkan ID
            $.ajax({
                url: '{{ route('ped-panel.admin.remark.supervisi') }}',
                method: 'GET',
                data: {
                    project_id: project_id
                },
                success: function(response) {
                    // Menampilkan hasil query di dalam modal
                    $('#modalContent').html(response);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#modal-kendala').on('show.bs.modal', function(e) {
            // Mendapatkan nilai ID dari tombol modal
            var project_id = $(e.relatedTarget).data('project_id');

            // Menampilkan nilai ID di dalam modal
            $('#modalId').text(project_id);
            // Melakukan permintaan AJAX untuk query berdasarkan ID
            $.ajax({
                url: '{{ route('ped-panel.admin.kendala.supervisi') }}',
                method: 'GET',
                data: {
                    project_id: project_id
                },
                success: function(response) {
                    // Menampilkan hasil query di dalam modal
                    $('#modalContentKendala').html(response);
                }
            });
        });
    });
</script>
