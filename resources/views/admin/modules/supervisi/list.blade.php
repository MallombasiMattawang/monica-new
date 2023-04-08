<div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ url('ped-panel/list-supervisis') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Project Name" value="{{ $search }}">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('ped-panel.admin.export.supervisi') }}" target="_blank" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Eksports</a>
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
                                    <th>tgl Install Done</th>
                                    <th>tgl Selesai CT</th>
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
                                @foreach ($supervisis as $d)
                                @php
                                // Mendapatkan data transaksi dari model
                                $remarks = App\Models\LogActual::where('project_id', $d->project_id)
                                ->whereNotNull('actual_message')
                                ->where('actual_message', '<>', '')->get();

                                // Mengelompokkan transaksi berdasarkan tanggal
                                $groupedRemarks = $remarks->groupBy(function($remark) {
                                    return $remark->created_at->format('Y-m-d');
                                });

                                $kendala = App\Models\LogActual::where('project_id', $d->project_id)
                                ->whereNotNull('actual_kendala')
                                ->where('actual_kendala', '<>', '')->get();

                                // Mengelompokkan transaksi berdasarkan tanggal
                                $groupedKendala = $kendala->groupBy(function($kendala) {
                                    return $kendala->created_at->format('Y-m-d');
                                });


                                  
                                        $tgl_mos = App\Models\TranBaseline::where('project_id', $d->project_id)
                                        ->whereNotNull('actual_finish')
                                        ->where('actual_finish', '<>', '')
                                            ->whereBetween('activity_id', [3, 9])
                                            ->orderBy('actual_finish', 'desc')
                                            ->first();
                                            $tgl_install_done = App\Models\TranBaseline::where('project_id', $d->project_id)
                                            ->whereNotNull('actual_finish')
                                            ->where('actual_finish', '<>', '')
                                                ->whereBetween('activity_id', [10, 19])
                                                ->orderBy('actual_finish', 'desc')
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
                                                                        <ul class="list-unstyled">
                                                                            @php
                                                                            foreach($groupedRemarks as $date => $remarks) {
                                                                            echo '<li>' . tgl_indo($date) . '</li>';
                                                                            echo '<ul>';
                                                                                foreach($remarks as $remark) {
                                                                                echo '<li>' . $remark->actual_message . '</li>';
                                                                                }
                                                                                echo '</ul>';
                                                                            }
                                                                            @endphp
                                                                        </ul>
                                                                    </td>
                                                                    <td>
                                                                        <ul class="list-unstyled">
                                                                            @php
                                                                            foreach($groupedKendala as $date => $kendalas) {
                                                                            echo '<li>' . tgl_indo($date) . '</li>';
                                                                            echo '<ul>';
                                                                                foreach($kendalas as $kendala) {
                                                                                echo '<li>' . $kendala->actual_kendala . '</li>';
                                                                                }
                                                                                echo '</ul>';
                                                                            }
                                                                            @endphp
                                                                        </ul>
                                                                    </td>
                                                                    <td>
                                                                        {{ isset($tgl_mos->actual_finish) && cek_all_delivery($d->project_id) == cek_all_delivery_finish($d->project_id) ? tgl_indo($tgl_mos->actual_finish) : '-' }}
                                                                    </td>
                                                                    <td>
                                                                        {{ isset($tgl_install_done->actual_finish) && cek_all_installasi($d->project_id) == cek_all_installasi_finish($d->project_id) ? tgl_indo($tgl_install_done->actual_finish) : '-' }}
                                                                    </td>
                                                                    <td>
                                                                        {{ isset($tgl_selesai_ct->actual_finish) ? tgl_indo($tgl_selesai_ct->actual_finish) : '-' }}
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
                                                                        {{ isset($tgl_install_done->actual_finish) && cek_all_installasi($d->project_id) == cek_all_installasi_finish($d->project_id)  ? selisih_hari($tgl_mos->actual_finish, $tgl_install_done->actual_finish) : '-' }}
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
                                                                        @elseif ($d->status_const_app == 'INSTALL DONE' || $d->status_const_app == 'SELESAI CT' || $d->status_const_app == 'SELESAI UT' || $d->status_const_app == 'INSTALL DONE' || $d->status_const_app == 'BAST-1')
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
