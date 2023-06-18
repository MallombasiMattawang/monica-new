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
                                    <th>nilai bast1 sap</th>
                                    <th>nilai bast1 smilley</th>
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
                                        // Mendapatkan data transaksi dari model
                                        $remarks = App\Models\LogActual::where('project_id', $d->project_id)
                                            ->whereNotNull('actual_message')
                                            ->where('actual_message', '<>', '')
                                            ->get();

                                        // Mengelompokkan transaksi berdasarkan tanggal
                                        $groupedRemarks = $remarks->groupBy(function ($remark) {
                                            return $remark->created_at->format('Y-m-d');
                                        });

                                        $kendala = App\Models\LogActual::where('project_id', $d->project_id)
                                            ->whereNotNull('actual_kendala')
                                            ->where('actual_kendala', '<>', '')
                                            ->get();

                                        // Mengelompokkan transaksi berdasarkan tanggal
                                        $groupedKendala = $kendala->groupBy(function ($kendala) {
                                            return $kendala->created_at->format('Y-m-d');
                                        });

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
                                        <td>{{ $d->{'tematik'} }}</td>
                                        <td>{{ $d->{'witel'} }}</td>
                                        <td>{{ $d->{'sto'} }}</td>
                                        <td>{{ $d->{'project_name'} }}</td>
                                        <td>{{ $d->{'mitra'} }}</td>
                                        <td>{{ $d->{'no_sp_telkom'} }}</td>
                                        <td>{{ $d->{'edc'} }}</td>
                                        <td>{{ $d->{'toc'} }}</td>
                                        <td>{{ $d->{'nilai_kontrak'} }}</td>
                                        <td>{{ $d->{'nilai_bast1_sap'} }}</td>
                                        <td>{{ $d->{'nilai_bast1_smilley'} }}</td>
                                        <td>{{ $d->{'plan_port'} }}</td>
                                        <td>{{ $d->{'real_port'} }}</td>
                                        <td>{{ $d->{'plan_homepass'} }}</td>
                                        <td>{{ $d->{'real_homepass'} }}</td>
                                        <td>{{ $d->{'name_waspang'} }}</td>
                                        <td>{{ $d->{'name_tim_ut'} }}</td>
                                        <td>{{ $d->{'status_const_app'} }}</td>
                                        <td>{{ $d->{'status_const_sap'} }}</td>
                                        <td>
                                            <p>
                                                <a class="btn btn-primary btn-sm" data-toggle="collapse"
                                                    href="#collapse_{{ $d->id }}" role="button"
                                                    aria-expanded="false" aria-controls="collapseExample">
                                                    View Remarks
                                                </a>
                                            </p>
                                            <div class="collapse" id="collapse_{{ $d->id }}"
                                                style="width: 800px !important;">
                                                <ul class="list-unstyled">
                                                    @php
                                                        $today = date('Y-m-d');
                                                        $start_date = strtotime($project->start_date); // konversi tanggal awal ke timestamp
                                                        $end_date = time(); // timestamp saat ini
                                                        $current_date = $start_date; // inisialisasi tanggal saat ini
                                                        echo '<li>' . date('d/m/Y', $current_date) . '</li>'; // tampilkan tanggal dalam format Y-m-d
                                                        while ($current_date <= $end_date) {
                                                            $current_date = strtotime('+1 day', $current_date); // tambahkan satu hari ke tanggal saat ini
                                                            if ($current_date <= strtotime($today)) {
                                                                echo '<li>' . date('d/m/Y', $current_date) . '</li>'; // tampilkan tanggal dalam format Y-m-d
                                                                $remarks_cek = App\Models\LogActual::where('project_id', $d->project_id)
                                                                    ->whereBetween('actual_start', [$project->start_date, date('Y-m-d', $current_date)])
                                                                    ->where('actual_status', 'belum')
                                                                    ->get();
                                                                $remarks_selesai = App\Models\LogActual::where('project_id', $d->project_id)
                                                                    ->where('actual_finish', date('Y-m-d', $current_date))
                                                                    ->where('actual_status', 'selesai')
                                                                    ->get();
                                                                $remarks_belum = App\Models\LogActual::where('project_id', $d->project_id)
                                                                    ->where('actual_start', date('Y-m-d', $current_date))
                                                                    ->where('actual_status', 'belum')
                                                                    ->get();

                                                                echo '<ul>';

                                                                foreach ($remarks_selesai as $remark) {
                                                                    $activity = App\Models\TranBaseline::where('id', $remark->tran_baseline_id)->first();
                                                                    echo '<li>' . trimActivity($activity->list_activity) . ' ' . $remark->actual_volume . ' dari ' . $activity->volume . ' ' . $activity->satuan . ' (DONE) </li>';
                                                                }
                                                                foreach ($remarks_belum as $remark) {
                                                                    $activity = App\Models\TranBaseline::where('id', $remark->tran_baseline_id)->first();
                                                                    echo '<li>' . trimActivity($activity->list_activity) . ' = ' . $remark->actual_volume . ' dari ' . $activity->volume . ' ' . $activity->satuan . '</li>';
                                                                    echo '<li>' . trimActivity($activity->list_activity) . ' = ' . $remark->actual_message . '</li>';
                                                                }
                                                                $activity_2 = App\Models\TranBaseline::where('project_id', $d->project_id)
                                                                    ->where('actual_status', 'belum')
                                                                    ->where('actual_start', '<', date('Y-m-d', $current_date))
                                                                    ->get();
                                                                foreach ($activity_2 as $a) {
                                                                    $remarks_today = App\Models\LogActual::where('tran_baseline_id', $a->id)
                                                                        ->where('actual_status', 'belum')
                                                                        ->first();
                                                                    echo '<li>' . trimActivity($a->list_activity) . ' = ' . $remarks_today->actual_volume . ' dari ' . $a->volume . ' ' . $a->satuan . '</li>';
                                                                }
                                                                echo '</ul>';
                                                            }
                                                        }

                                                    @endphp

                                                </ul>
                                            </div>

                                        </td>
                                        <td>
                                            <p>
                                                <a class="btn btn-primary btn-sm" data-toggle="collapse"
                                                    href="#collapse_kendala_{{ $d->id }}" role="button"
                                                    aria-expanded="false" aria-controls="collapseExample">
                                                    View Kendala
                                                </a>
                                            </p>
                                            <div class="collapse" id="collapse_kendala_{{ $d->id }}">
                                                <ul class="list-unstyled">
                                                    @php
                                                        foreach ($groupedKendala as $date => $kendalas) {
                                                            echo '<li>' . tgl_indo($date) . '</li>';
                                                            echo '<ul>';
                                                            foreach ($kendalas as $kendala) {
                                                                echo '<li>' . $kendala->actual_kendala . '</li>';
                                                            }
                                                            echo '</ul>';
                                                        }
                                                    @endphp
                                                </ul>
                                            </div>

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
                                        <td>{{ $d->{'flaging_mitra'} }}</td>
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
                                            @if ($d->status_golive == 'GOLIVE')
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
