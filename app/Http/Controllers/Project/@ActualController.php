<<?php 
public function actualActivityAddDate(Request $request)
{
    $request->validate(
        [
            'file' => 'required|mimes:jpg,png,zip,rar,pdf,doc,docx,xlsx,csv,sql|max:25000',
            'actual_volume' => 'required',
            'actual_status' => 'required'
        ],
        [
            'actual_volume.required' => 'Actual Volume tidak boleh kosong',
            'actual_status.required' => 'Actual Status tidak boleh kosong',
            'file.required' => 'Evident tidak boleh kosong.',
            'file.mimes' => 'Evident yang diizinkan masuk (jpg,png,zip,rar,pdf,doc,docx,xlsx,csv,sql).',
            'file.max' => 'Ukuran Evident tidak boleh lebih dari 25 MB.',
        ]
    );
    // menangkap file 
    $file = $request->file('file');
    // membuat nama file unik
    $nama_file = now()->timestamp . '.' . $file->getClientOriginalExtension();
    // upload ke folder public
    $file->move('uploads/evident', $nama_file);
    // File path
    $filepath = 'evident/' . $nama_file;

    //INITIAL VARIABEL REQUEST
    $baseline_id =  $request->baseline_id;
    $actual_status = $request->actual_status;
    $actual_message = $request->actual_message;
    $actual_kendala = $request->actual_kendala;
    $actual_finish_verifikasi = null;
    $actual_durasi_verifikasi = null;
    $plan_golive = null;

    //DARI TABEL BASELINE
    $baseline = TranBaseline::findOrFail($request->baseline_id);
    $actual_volume = (int) $baseline->actual_volume + (int) $request->actual_volume;
    $actual_start =  $baseline->actual_start;
    $actual_finish = null;
    $actual_durasi = null;


    //CARI TANGGAL START
    if ($baseline->actual_start) {
        $actual_start =  $baseline->actual_start;
    } else {
        $actual_start = date('Y-m-d');
    }
    // CARI STATUS CONST
    if ($request->activity_id >= 1 && $request->activity_id <= 2) {
        $status_const = 'PREPARING';
    } else if ($request->activity_id >= 3 && $request->activity_id <= 9) {
        $status_const = 'MATERIAL DELIVERY';
        $cek_const = TranBaseline::select('actual_start, actual_finish')
            ->where('project_id', $baseline->project_id)
            ->whereBetween('activity_id', [3, 9])->count();
        $cek_const_actual = TranBaseline::select('actual_start, actual_finish')
            ->where('project_id', $baseline->project_id)
            ->whereNotNull('actual_start')
            ->whereBetween('activity_id', [3, 9])->count();
        if ($cek_const_actual == $cek_const) {
            $status_const = "MATERIAL DELIVERY ON SITE";
        }
    } else if ($request->activity_id >= 10 && $request->activity_id <= 19) {
        $status_const = 'INSTALASI';
    } else if ($request->activity_id == 19 && $actual_status == 'selesai') {
        $status_const = 'INSTALL DONE';
    } else if ($request->activity_id == 20) {
        $status_const = 'INSTALL DONE';
    } else if ($request->activity_id == 22) {
        $status_const = 'REKON';
    } else {
        $status_const = '';
    }
    //CARI STATUS DOC         
    if ($request->activity_id >= 1 && $request->activity_id <= 21) {
        $status_doc = 'KONSTRUKSI';
    } else if ($request->activity_id >= 22 && $request->activity_id <= 23) {
        $status_doc = 'ADMINISTRASI';
    } else {
        $status_doc = '';
    }

    //CARI ACTUAL PROGRESS
    if ($actual_status == 'belum') {
        $actual_progress = ($actual_volume / $baseline->volume) * 100;
        $actual_progress = Round($actual_progress, 1);
        if ($actual_progress >= 100) {
            $actual_progress = 90;
        }
        $actual_task = 'NEED UPDATED';
    } else {
        $actual_finish = date('Y-m-d');
        $actual_task = '';
        $actual_progress = 100;
        $start = strtotime($actual_start);
        $finish = strtotime($actual_finish);
        $jarak = $finish - $start;
        $actual_durasi = $jarak / 60 / 60 / 24;
        $actual_durasi = $actual_durasi + 1;
    }

    //CARI PROGRESS BOBOT
    $progress_bobot =  ($actual_progress / 100) * $baseline->bobot;
    $progress_bobot =  Round($progress_bobot, 1);

    // ACTIVITY PREPARING - TERMINASI / JOINTING TIDAK VERIFIKASI WASPANG
    if ($request->activity_id >= 1 && $request->activity_id <= 19) {
        $actual_task = 'APPROVED';
        $actual_finish_verifikasi = $actual_finish;
        $actual_durasi_verifikasi = $actual_durasi;
        if ($actual_status == 'belum') {
            $actual_task = 'NEED UPDATED';
            $actual_finish_verifikasi = null;
            $actual_durasi_verifikasi = null;
        }
    } else if ($request->activity_id == 20) {
        $actual_task = 'NEED APPROVED WASPANG';
        $actual_finish_verifikasi = null;
        $actual_durasi_verifikasi = null;
    } else if ($request->activity_id == 21) {
        $actual_task = 'NEED APPROVED TIM UT';
        $actual_finish_verifikasi = null;
        $actual_durasi_verifikasi = null;
    } else {
        $actual_task = null;
        $actual_finish_verifikasi = $actual_finish;
        $actual_durasi_verifikasi = $actual_durasi;
    }

    try {
        DB::beginTransaction();

        //SIMPAN KE LOG ACTUAL
        $logActual = LogActual::create([
            'project_id' => $baseline->project_id,
            'tran_baseline_id' => $baseline->id,
            'actual_volume' => $request->actual_volume,
            'actual_progress' =>  $actual_progress,
            'actual_evident' => $filepath,
            'actual_status' => $actual_status,
            'actual_message' => $actual_message,
            'actual_kendala' => $actual_kendala,
            'progress_bobot' => $progress_bobot,
            'actual_start' => $actual_start,
            'actual_finish' => $actual_finish,
            'actual_durasi' => $actual_durasi,
        ]);

        // UPDATE ACTUAL DI TRANSBASELINE    
        TranBaseline::where("id", $baseline->id)
            ->update([
                'actual_status' => $actual_status,
                'actual_start' => $actual_start,
                'actual_finish' => $actual_finish_verifikasi,
                'actual_task' =>  $actual_task,
                'actual_progress' =>  $actual_progress,
                'actual_volume' =>  $actual_volume,
                'actual_durasi' => $actual_durasi_verifikasi,
                'actual_message' => $actual_message,
                'actual_kendala' => $actual_kendala,
            ]);

        //UPDATE SUPERVISI
        $today = date('Y-m-d');
        $tambah_hari = 7;
        $plan_finish_const = $baseline->plan_start;
        $sumPlanBobot = 0;
        if ($plan_finish_const <= $today) {
            $sumPlanBobot = TranBaseline::where("project_id", $baseline->project_id)->where('activity_id', '<=', $request->activity_id)->sum('bobot');
        }
        $sum_selesai = TranBaseline::where("project_id", $baseline->project_id)->where("actual_progress", 100)->sum('bobot');
        $sum_belum = TranBaseline::where("project_id", $baseline->project_id)->whereBetween('actual_progress', [1, 99])->sum('progress_bobot');

        if ($status_const == 'INSTALL DONE') {
            $plan_golive = date('Y-m-d', strtotime($today . ' + ' . $tambah_hari . ' days'));
        }
        TranSupervisi::where("project_id", $baseline->project_id)
            ->update([
                'status_const' => $status_const,
                'status_doc' => $status_doc,
                'progress_plan' => $sumPlanBobot,
                'progress_actual' =>  $sum_selesai + $sum_belum,
                'remarks' => $actual_message,
                'kendala' => $actual_kendala,
                'task' => 'PROGRESS ' . $status_const,
                'plan_golive' => $plan_golive
            ]);

        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        // melakukan sesuatu dengan error handling, seperti log atau memberikan pesan error ke user
        $supervisi = TranSupervisi::where("project_id", $baseline->project_id)->first();

        return redirect()->route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)])->with(['error' => 'Update Actual #' . $baseline->list_activity . ' Gagal, Terjadi kesalahan sistem. Pesan error: ' . $e->getMessage()]);
    }


    $supervisi = TranSupervisi::where("project_id", $baseline->project_id)->first();
    return redirect()->route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)])->with(['success' => 'Update Actual #' . $baseline->list_activity . ' Berhasil']);
}