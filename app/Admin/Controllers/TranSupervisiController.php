<?php

namespace App\Admin\Controllers;

//use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\MstWitel;
use App\Models\LogActual;
//use Encore\Admin\Admin;
use App\Models\MstProject;
use App\Admin\Forms\addPlan;
use App\Models\MstWaspangUt;
use App\Models\TranBaseline;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;

use App\Models\TranSupervisi;
use Encore\Admin\Widgets\Box;
use App\Admin\Forms\addActual;
use Encore\Admin\Widgets\Form;
use App\Admin\Forms\addApprove;
use App\Models\RefListActivity;
use Encore\Admin\Facades\Admin;
use App\Models\TranAdministrasi;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\DB;
use App\Admin\Actions\Project\Plan;
use App\Admin\Forms\addAdministrasi;
use App\Admin\Actions\Project\Actual;
use App\Admin\Actions\Project\Baseline;
use App\Admin\Actions\Project\ActualActivity;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;
use App\Models\LogPlan;
use App\Models\MstSap;
use App\Models\MstSmilleyNilai;
use App\Models\User;

class TranSupervisiController extends AdminController
{
  /**
   * Title for current resource.
   *
   * @var string
   */
  protected $title = 'TABLE SUPERVISI';

  /**
   * Make a grid builder.
   *
   * @return Grid
   */
  protected function grid()
  {

    $grid = new Grid(new TranSupervisi());

    if (Admin::user()->inRoles(['witel'])) {
      $grid->model()->where('witel_id', '=', Admin::user()->id);
    }
    $grid->filter(function ($filter) {
      $filter->disableIdFilter();
      $filter->column(1 / 2, function ($filter) {
        $filter->like('project_name', 'LOP / SITE ID');
        $filter->like('supervisi_project.witel_id', 'WITEL');
        $filter->like('supervisi_sap.kontrak', 'NO. SP TELKOM');
      });

      $filter->column(1 / 2, function ($filter) {
        $filter->like('supervisi_mitra.nama_mitra', 'MITRA');
        $filter->like('supervisi_project.sto_id', 'STO');
      });
    });
    $grid->disableCreateButton();
    $grid->disableRowSelector();
    $grid->disableColumnSelector();
    $grid->actions(function ($actions) {
      $actions->disableEdit();
      $actions->disableDelete();
      //$actions->disableView();

      if (Admin::user()->inRoles(['administrator', 'witel'])) {
        if ($actions->row->getOriginal('task') == 'CREATE BASELINE') {
          $actions->add(new Baseline);
        } else {
          $actions->add(new Baseline);
          $actions->add(new Actual);
        }
      }
    });
    $grid->fixColumns(2, -1);

    $grid->column('supervisi_project.tematik', __('Tematik'));
    $grid->column('supervisi_witel.name', __('Witel'));
    $grid->column('supervisi_project.sto_id', __('STO'));
    $grid->column('project_name', __('Project name'));
    $grid->column('supervisi_mitra.nama_mitra', __('Mitra'));
    $grid->column('supervisi_sap.kontrak', __('NO. SP TELKOM'));
    $grid->column('supervisi_waspang.name')->modal('Waspang', function ($model) {
      $id = $model->id;
      $form = new Form();
      $form->action('add-waspang');
      $form->method('get');
      $form->hidden('id')->default($id);
      $form->select('waspang_id', 'Pilih Waspang')->options(
        User::selectRaw('CONCAT(nik, " | ", name) as full_name, id')->where('role', 'waspang')
          ->pluck('full_name', 'id')
      );
      return $form;
    });
    $grid->column('supervisi_tim_ut.name')->modal('TIM UT', function ($model) {
      $id = $model->id;
      $form = new Form();
      $form->action('add-ut');
      $form->method('get');
      $form->hidden('id')->default($id);
      $form->select('waspang_id', 'Pilih TIM UT')->options(
        User::selectRaw('CONCAT(nik, " | ", name) as full_name, id')->where('role', 'tim_ut')
          ->pluck('full_name', 'id')
      );
      return $form;
    });
    $grid->column('status_update')->display(function ($status_update) {
      $cek_status = TranBaseline::select('actual_task')
        ->where('project_id', $this->project_id)
        ->first();
      if (isset($cek_status->actual_task)) {
        return $cek_status->actual_task;
      }
    });

    $grid->column('progress_plan')->display(function ($progress_plan) {
      $today = date('Y-m-d');
      $project_id = $this->project_id;
      $start_date = MstProject::select('start_date')
        ->where('id', $this->project_id)
        ->first();
      $progress_plan = TranBaseline::where('project_id', $project_id)
        ->whereBetween('plan_finish', [$start_date->start_date, $today])
        ->sum('bobot');
      return "<span style='color:blue'>$progress_plan %</span>";
    });

    $grid->column('progress_actual')->display(function ($progress_actual) {
      return "<span style='color:blue'>$progress_actual %</span>";
    });
    Admin::style(
      '.table {
            #background: #ee99a0;
            border-radius: 0.2rem;
            width: 100%;
            padding-bottom: 1rem;
            color: #212529;
            margin-bottom: 0;
          }
          .table th {
            text-transform: uppercase;
            white-space: nowrap;
            background-color: #ffffd5;
          }
          .table td {
            text-align: center;
          }'


    );
    Admin::script('
    $("form").on( "submit", function( event ) {
           // $.admin.reload();
      $(".modal").modal("hide");
  });
    ');
    return $grid;
  }

  /**
   * Make a show builder.
   *
   * @param mixed $id
   * @return Show
   */
  protected function detail($id)
  {
    $supervisi = TranSupervisi::findOrFail($id);
    $data = MstProject::where('id', $supervisi->project_id)->first();
    $check_sap = MstSap::where('name', $data->lop_site_id)->exists();
    $check_smilley = MstSmilleyNilai::where('kt_lokasi', $data->lop_site_id)->exists();
    $sap = '0';
    $smilley = '0';
    if ($check_sap == 1) {
      $sap = MstSap::where('name', $data->lop_site_id)->first();
    }
    if ($check_smilley == 1) {
      $smilley = MstSmilleyNilai::where('kt_lokasi', $data->lop_site_id)->first();
    }

    $tgl_ct = TranBaseline::where('project_id', $supervisi->project_id)->where('activity_id', 20)->first();
    $tgl_ut = TranBaseline::where('project_id', $supervisi->project_id)->where('activity_id', 21)->first();
    $tgl_rekon = TranBaseline::where('project_id', $supervisi->project_id)->where('activity_id', 22)->first();
    $tgl_bast = TranBaseline::where('project_id', $supervisi->project_id)->where('activity_id', 23)->first();

    return view('admin.modules.supervisi.detail', [
      'data' => $data,
      'supervisi' => $supervisi,
      'sap' => $sap,
      'smilley' => $smilley,
      'tgl_ct' => $tgl_ct,
      'tgl_ut' => $tgl_ut,
      'tgl_rekon' => $tgl_rekon,
      'tgl_bast' => $tgl_bast
    ]);
  }


  public function formBaseline($id)
  {
    return Admin::content(function (Content $content) use ($id) {
     
      $project = MstProject::where("id", $id)->first();
      if ($project->status_project == 'USULAN' || $project->status_project == 'DROP') {
        return abort(404);
      }
      $supervisi = TranSupervisi::where("project_id", $id)->first();
      $content->header('TABEL SUPERVISI');
      $content->description('Baseline Activity');
      $content->breadcrumb(
        ['text' => 'Supervisi', 'url' => 'tran-supervisis'],
        ['text' => $project->lop_site_id, 'url' => 'tran-supervisis/'. $supervisi->id .''],
        ['text' => 'Baseline Activity']
      );
      $checkBaseline = TranBaseline::where("project_id", $id)->exists();
      if ($checkBaseline == 1) {
        $lists = TranBaseline::where("project_id", $id)->get();
        
        $waspang = User::where('role', '=',  'waspang')->get();
        $tim_ut = User::where('role', '=',  'tim_ut')->get();
        $countBase = TranBaseline::where("project_id", $id)->where('bobot', '>=', '1')->count();
        $sumBase = TranBaseline::where("project_id", $id)->where('bobot', '>=', '1')->sum('bobot');
        $countPlan = TranBaseline::where("project_id", $id)->where('plan_durasi', '>=', '1')->count();
        $sumDurasi = TranBaseline::where("project_id", $id)->where('plan_durasi', '>=', '1')->sum('plan_durasi');

        $content->body(view('admin.modules.supervisi.view-baseline', [
          'project' => $project,
          'countBase' => $countBase,
          'sumBase' => $sumBase,
          'countPlan' => $countPlan,
          'sumDurasi' =>  $sumDurasi,
          'lists' => $lists,
          'id' => $id,
          'waspang' => $waspang,
          'tim_ut' => $tim_ut,
          'supervisi' => $supervisi,

        ]));
      } else if ($checkBaseline == 0) {
        $lists = RefListActivity::all();
        $supervisi = TranSupervisi::where("project_id", $id)->first();
        $deliveryKabel = $project->panjang_feeder + $project->panjang_dist;
        $deliveryTiang = $project->tiang_baru;
        $deliveryOdp =  $project->odp_odp_8 + $project->odp_odp_16;
        $deliveryOdc =  $project->odc_total;
        $penarikanFeeder = $project->panjang_feeder;
        $penarikanDist = $project->panjang_dist;
        $countBase = 0;
        $countPlan = 0;
        $sumDurasi = 0;
        $content->body(view('admin.modules.supervisi.form-baseline', [
          'project' => $project,
          'deliveryKabel' => $deliveryKabel,
          'deliveryTiang' => $deliveryTiang,
          'deliveryOdp' => $deliveryOdp,
          'deliveryOdc' => $deliveryOdc,
          'penarikanFeeder' => $penarikanFeeder,
          'penarikanDist' => $penarikanDist,
          'countBase' => $countBase,
          'countPlan' => $countPlan,
          'sumDurasi' =>  $sumDurasi,
          'lists' => $lists,
          'supervisi' => $supervisi

        ]));
      } else {
        return abort(404);
      }
    });
  }


  
  public function createBaseline(Request $request)
  {   
    $request->validate([
      'volume.*' => 'required|numeric|gt:0',
      'bobot.*' => 'required|numeric|gt:0',
      'total_bobot' => 'required|numeric|min:100|max:100'
    ]);

    foreach ($_POST['activity_id'] as $row => $value) {
      $tranBaseline = TranBaseline::create([
        'project_id' => $request->project_id,
        'activity_id' => $_POST['activity_id'][$row],
        'category_id' => $_POST['category_id'][$row],
        'list_activity' => $_POST['list_activity'][$row],
        'bobot' => $_POST['bobot'][$row],
        'volume' => $_POST['volume'][$row],
        'satuan' => $_POST['satuan'][$row],

      ]);

      $tranBaseline->save();

      $cek_supervisi = TranSupervisi::where('project_id', $request->project_id)->first();
      $task = 'PENENTUAN WASPANG DAN TIM UT';
      if ($cek_supervisi->waspang_id != null && $cek_supervisi->tim_ut_id != null) {
        $task = "PENGISIAN PLAN BY MITRA";
      }
      TranSupervisi::where("project_id", $request->project_id)
        ->update([
          'task' =>  $task
        ]);
    }

    admin_success('Baseline Activity Project Updated');
    admin_toastr('Baseline Activity Project Updated', 'success');
    return back();
  }

  public function updateBaseline(Request $request)
  {
    $request->validate([
      'waspang_id' =>  'required',
      'tim_ut_id' =>  'required',
    ]);
    TranSupervisi::where("project_id", $request->project_id)
      ->update([
        'waspang_id' =>  $request->waspang_id,
        'tim_ut_id' =>  $request->tim_ut_id,
        'task' =>  'PENGISIAN PLAN BY MITRA'
      ]);
    admin_success('Baseline Activity Project Updated');
    admin_toastr('Baseline Activity Project Updated', 'success');
    return back();
  }

  public function planActivity(Content $content)
  {
    return Admin::content(function (Content $content) {

      $id = $_GET['id'];
      $project = MstProject::where("id", $id)->first();
      $supervisi = TranSupervisi::where("project_id", $id)->first();
      if ($supervisi->mitra_id != Admin::user()->id) {
        return abort(404);
      }
      //$checkBaseline = TranBaseline::where("project_id", $id)->exists();
      $content->header('Create Plan Activity Project');
      $content->description('');

      //if ($checkBaseline == 1) {
      $lists = TranBaseline::where("project_id", $id)->get();

      $waspang = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')->where('role_id', '=',  5)->get();
      $tim_ut = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')->where('role_id', '=',  6)->get();
      $countBase = TranBaseline::where("project_id", $id)->where('bobot', '>=', '1')->count();
      $sumBase = TranBaseline::where("project_id", $id)->where('bobot', '>=', '1')->sum('bobot');
      $countPlan = TranBaseline::where("project_id", $id)->where('plan_durasi', '>=', '1')->count();
      $sumDurasi = TranBaseline::where("project_id", $id)->where('plan_durasi', '>=', '1')->sum('plan_durasi');
      $cek_preparing = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
        ->where('project_id', $project->id)
        ->where('activity_id', 2)
        ->first();
      $cek_material = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
        ->where('project_id', $project->id)
        ->where('activity_id', 9)
        ->first();
      $cek_jointing = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
        ->where('project_id', $project->id)
        ->where('activity_id', 19)
        ->first();
      $cek_comtes = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
        ->where('project_id', $project->id)
        ->where('activity_id', 20)
        ->first();
      $cek_ut = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
        ->where('project_id', $project->id)
        ->where('activity_id', 21)
        ->first();
      $cek_rekon = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
        ->where('project_id', $project->id)
        ->where('activity_id', 22)
        ->first();
      $cek_bast = \App\Models\TranBaseline::select(['id', 'plan_finish', 'plan_start'])
        ->where('project_id', $project->id)
        ->where('activity_id', 23)
        ->first();
      $cek_all_delivery = TranBaseline::select('plan_finish')
        ->where('project_id', $project->id)
        ->whereBetween('activity_id', [3, 9])->count();

      $cek_all_delivery_finish = TranBaseline::select('plan_finish')
        ->where('project_id', $project->id)
        ->whereNotNull('plan_finish')
        ->whereBetween('activity_id', [3, 9])->count();

      $cek_all_installasi = TranBaseline::select('plan_finish')
        ->where('project_id', $project->id)
        ->whereBetween('activity_id', [10, 19])->count();

      $cek_all_installasi_finish = TranBaseline::select('plan_finish')
        ->where('project_id', $project->id)
        ->whereNotNull('plan_finish')
        ->whereBetween('activity_id', [10, 19])->count();


      $content->body(view('admin.modul_plan.update', [
        'project' => $project,
        'countBase' => $countBase,
        'sumBase' => $sumBase,
        'countPlan' => $countPlan,
        'sumDurasi' =>  $sumDurasi,
        'lists' => $lists,
        'id' => $id,
        'waspang' => $waspang,
        'tim_ut' => $tim_ut,
        'supervisi' => $supervisi,
        'cek_preparing' => $cek_preparing,
        'cek_material' => $cek_material,
        'cek_jointing' => $cek_jointing,
        'cek_comtes' => $cek_comtes,
        'cek_ut' => $cek_ut,
        'cek_rekon' => $cek_rekon,
        'cek_bast' => $cek_bast,
        'cek_all_delivery' => $cek_all_delivery,
        'cek_all_delivery_finish' => $cek_all_delivery_finish,
        'cek_all_installasi' => $cek_all_installasi,
        'cek_all_installasi_finish' => $cek_all_installasi_finish,

      ]));
      //}
    });
  }



  public function addPlan(Content $content)
  {
    return $content
      ->title('Plan Activity')
      ->body(new addPlan());
  }

  public function addPlanActivity(Request $request)
  {
    $baseline = TranBaseline::where('id', $request->baseline_id)->first();
    $project = MstProject::where('id', $baseline->project_id)->first();
    if ($request->plan_finish >= $request->plan_start && $request->plan_finish <=  $project->end_date) {
      //delete di logPlan
      LogPlan::where('baseline_id', $baseline->id)->delete();

      // udpated plan
      TranBaseline::where("id", $request->baseline_id)
        ->update([
          'plan_start' => $request->plan_start,
          'plan_finish' => $request->plan_finish,
          'plan_durasi' => $request->plan_durasi
        ]);
      $start = $request->plan_start;
      $log_bobot = $baseline->bobot / $request->plan_durasi;

      for ($i = 1; $i <= $request->plan_durasi; $i++) {
        $logPlan = LogPlan::create([
          'project_id' => $baseline->project_id,
          'baseline_id' => $baseline->id,
          'log_date' =>  $start,
          'log_bobot' =>  $log_bobot
        ]);
        $logPlan->save();
        $start = date('Y-m-d', strtotime('+1 day', strtotime($start))); //looping tambah 1 date
      }

      if ($baseline->activity_id == 2 || $baseline->activity_id == 9 || $baseline->activity_id == 19 || $baseline->activity_id == 20 || $baseline->activity_id == 21 || $baseline->activity_id == 22 || $baseline->activity_id == 23) {
        TranBaseline::where("id", $request->baseline_id + 1)
          ->update([
            'plan_start' => $request->plan_finish,
          ]);

        TranBaseline::where("project_id", $baseline->project_id)->where('id', '>', $request->baseline_id)
          ->update([
            //'plan_start' => null,
            'plan_finish' => null,
            'plan_durasi' => null
          ]);
        TranBaseline::where("project_id", $baseline->project_id)->where('id', '>', $request->baseline_id + 1)
          ->update([
            'plan_start' => null,
            'plan_finish' => null,
            'plan_durasi' => null
          ]);
      }
      //  }
      //ketika ada update 

      return response()->json(['success' => 'update plan berhasil']);
    } else {
      return response()->json(['error' => 'Tanggal finish tidak boleh lebih kecil dari tanggal start atau lewat ketentuan tanggal finish baseline <br>' . $project->end_date . '']);
    }

    return redirect()->back();
  }



  public function submitPlan(Request $request)
  {
    MstProject::where("id", $request->id)
      ->update([
        'status_plan' => '1',
      ]);

    TranSupervisi::where("project_id", $request->id)
      ->update([
        'task' => 'PENGISIAN ACTUAL',
      ]);
    admin_success('Submit Plan Success!');
    admin_toastr('Submit Plan Success!', 'success');
    return back();
  }


  public function actualActivity(Content $content)
  {
    return Admin::content(function (Content $content) {

      $id = $_GET['id'];
      $project = MstProject::where("id", $id)->first();
      $supervisi = TranSupervisi::where("project_id", $id)->first();
      if (Admin::user()->inRoles(['mitra'])) {
        if ($supervisi->mitra_id != Admin::user()->id) {
          return abort(404);
        }
      }

      if (Admin::user()->inRoles(['waspang'])) {
        if ($supervisi->waspang_id != Admin::user()->id) {
          return abort(404);
        }
      }


      $content->header('Lembar Kerja');
      $content->description('Create Actual Activity Project');


      $lists = TranBaseline::where("project_id", $id)->get();
      $lists_asc_date = TranBaseline::where("project_id", $id)->orderBy('plan_finish', 'ASC')->get();
      $end_date_plan = TranBaseline::where("project_id", $id)->whereNotNull('plan_finish')->orderBy('plan_finish', 'Desc')->first();
      $end_date_actual = TranBaseline::where("project_id", $id)->whereNotNull('actual_finish')->orderBy('actual_finish', 'Desc')->first();


      $waspang = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')->where('role_id', '=',  5)->get();
      $tim_ut = MstWaspangUt::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')->where('role_id', '=',  6)->get();
      $countBase = TranBaseline::where("project_id", $id)->where('bobot', '>=', '1')->count();
      $sumBase = TranBaseline::where("project_id", $id)->where('bobot', '>=', '1')->sum('bobot');
      $countPlan = TranBaseline::where("project_id", $id)->where('plan_durasi', '>=', '1')->count();
      $sumDurasi = TranBaseline::where("project_id", $id)->where('plan_durasi', '>=', '1')->sum('plan_durasi');
      $countActual = TranBaseline::where("project_id", $id)->where('actual_finish', '>=', '1')->count();
      $today = date('Y-m-d');
      $progress_plan = TranBaseline::where("project_id", $id)->whereBetween('plan_finish', [$project->start_date,  $today])->sum('bobot');

      $cek_last_preparing = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->where('activity_id', 2)
        ->first();
      $cek_all_delivery = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->whereBetween('activity_id', [3, 9])->count();

      $cek_all_delivery_finish = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->whereNotNull('actual_finish')
        ->whereBetween('activity_id', [3, 9])->count();

      $cek_all_installasi = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->whereBetween('activity_id', [10, 19])->count();

      $cek_all_installasi_finish = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->whereNotNull('actual_finish')
        ->whereBetween('activity_id', [10, 19])->count();

      $cek_commisioning_tes = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->whereNotNull('actual_finish')
        ->where('activity_id', 20)->exists();

      $cek_ut = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->where('approval_tim_ut', 'approve')
        ->whereNotNull('actual_finish')
        ->where('activity_id', 21)->exists();

      $cek_rekon = TranBaseline::select('actual_finish')
        ->where('project_id', $id)
        ->where('actual_task', 'APPROVED')
        ->whereNotNull('actual_finish')
        ->where('activity_id', 22)->exists();
      $sum_selesai = TranBaseline::where("project_id", $id)->where("actual_progress", 100)->sum('bobot');
      $sum_belum = TranBaseline::where("project_id", $id)->whereBetween('actual_progress', [1, 99])->sum('progress_bobot');
      $content->body(view('admin.modul_actual.update', [
        'project' => $project,
        'countBase' => $countBase,
        'sumBase' => $sumBase,
        'countPlan' => $countPlan,
        'countActual' => $countActual,
        'sumDurasi' =>  $sumDurasi,
        'lists' => $lists,
        'lists_asc_date' => $lists_asc_date,
        'id' => $id,
        'waspang' => $waspang,
        'tim_ut' => $tim_ut,
        'supervisi' => $supervisi,
        'cek_last_preparing' => $cek_last_preparing,
        'cek_all_delivery' => $cek_all_delivery,
        'cek_all_delivery_finish' => $cek_all_delivery_finish,
        'cek_all_installasi' => $cek_all_installasi,
        'cek_all_installasi_finish' => $cek_all_installasi_finish,
        'cek_commisioning_tes' => $cek_commisioning_tes,
        'cek_ut' => $cek_ut,
        'cek_rekon' => $cek_rekon,
        'progress_plan' => $progress_plan,
        'sum_selesai' => $sum_selesai,
        'sum_belum' => $sum_belum,
        // 'start' => $start,
        'end_date_plan' => $end_date_plan,
        'end_date_actual' => $end_date_actual,

      ]));
    });
  }

  public function addActual(Content $content)
  {
    return $content
      ->title('Actual Activity')
      ->body(new addActual());
  }

  // public function addApprove(Content $content)
  // {
  //   return $content
  //     ->title('Approval Activity')
  //     ->body(new addApprove());
  // }

  public function addApprove(Content $content)
  {
    return $content
      ->title('Approval Actual')
      ->row(function (Row $row) {
        $id = $_GET['id'];
        $log = LogActual::where('tran_baseline_id', $id)->get();
        $baseline = TranBaseline::findOrFail($id);
        $supervisi = TranSupervisi::where('project_id', $baseline->project_id)->first();
        $sumProgress = LogActual::where("tran_baseline_id", $id)->where('approval_waspang', 'approve')->whereNotNull("actual_start")->sum('actual_progress');
        $approvalBy = 'WASPANG';
        if ($baseline->activity_id == 21) {
          $approvalBy = 'TIM UT';
          $sumProgress = LogActual::where("tran_baseline_id", $id)->where('approval_tim_ut', 'approve')->whereNotNull("actual_start")->sum('actual_progress');
        }
        if ($sumProgress > 100) {
          $sumProgress = 100;
        }
        $data = view('admin.modul_actual.approval', [
          'log' => $log,
          'baseline' => $baseline,
          'supervisi' => $supervisi,
          'approvalBy' => $approvalBy,
          'sumProgress' => $sumProgress
        ]);
        $row->column(12, new Box('Approval By ' . $approvalBy, $data));
      });
  }

  public function saveApprove(Request $request)
  {
    print_r($_POST);
    $waspangBy = NULL;
    $tim_utBy = NULL;
    $approval_waspang = '';
    $approval_ut = '';


    $log = LogActual::where('id', $request->id)->first();
    $baseline = TranBaseline::where('id', $log->tran_baseline_id)->first();
    $supervisi = TranSupervisi::where('project_id', $baseline->project_id)->first();

    //INITIAL VARIABEL
    $actual_status = $log->actual_status;
    $actual_start =  $log->actual_start;
    $actual_finish = null;
    $actual_durasi = null;
    $actual_progress = $log->actual_progress;
    $progress_bobot = $log->progress_bobot;
    $actual_volume = $log->actual_volume;

    $status_const = $supervisi->status_const;
    $status_doc = $supervisi->status_doc;

    if ($baseline->activity_id >= 1 && $baseline->activity_id <= 20) {
      $approval_waspang = $request->approval;
      $waspangBy = Admin::user()->id;
    }
    if ($baseline->activity_id == 21) {
      $approval_ut = $request->approval;
      $tim_utBy = Admin::user()->id;
    }


    //STATUS CONSTS BELUM
    if ($actual_status == 'belum') {
      $actual_start = date('Y-m-d');
      $actual_task = 'NEED UPDATED';
    }
    //STATUS CONSTS SELESAI
    if ($actual_status == 'selesai') {
      if ($actual_start == null) {
        $actual_start = date('Y-m-d');
      }
      $actual_finish = date('Y-m-d');
      $actual_task = 'APPROVED';
      $actual_progress = 100;
      $start = strtotime($actual_start);
      $finish = strtotime($actual_finish);

      $jarak = $finish - $start;
      $actual_durasi = $jarak / 60 / 60 / 24;
      $actual_durasi = $actual_durasi + 1;



      //CARI STATUS DOC 
      //$status_doc = '';
      if ($baseline->activity_id >= 1 && $baseline->activity_id <= 21) {
        $status_doc = 'KONSTRUKSI';
      }
      if ($baseline->activity_id >= 22 && $baseline->activity_id <= 23) {
        $status_doc = 'ADMINISTRASI';
      }
    }
    // UPDATE LOG ATUAL

    //JIKA DIREJECT
    if ($approval_waspang == 'reject' || $approval_ut == 'reject') {
      $actual_start = null;
      $actual_finish = null;
      $actual_task = 'REJECTED';

      // UPDATE LOG ATUAL
      LogActual::where("tran_baseline_id", $baseline->id)->where('approval_waspang', NULL)
        ->update([
          'approval_waspang' => $approval_waspang,
          'approval_tim_ut' => $approval_ut,
          'approval_message' =>  $request->approval_message,
          'waspang_by' => $waspangBy,
          'tim_ut_by' => $tim_utBy,
        ]);

      // UPDATE ACTUAL DI TRANSBASELINE    

      if ($baseline->activity_id >= 1 && $baseline->activity_id <= 20) {
        $sumActualVolume = LogActual::where("project_id", $baseline->project_id)->where('approval_waspang',  'approve')->where("tran_baseline_id", $baseline->id)->sum('actual_volume');
        $log_prev = LogActual::where('tran_baseline_id', $baseline->id)->where('approval_waspang', 'approve')->orderBy('id', 'DESC')->first();
        if (isset($log_prev)) {
          $actual_progress = $log_prev->actual_progress;
        }
      }
      if ($baseline->activity_id == 21) {
        $sumActualVolume = LogActual::where("project_id", $baseline->project_id)->where('approval_tim_ut',  'approve')->where("tran_baseline_id", $baseline->id)->sum('actual_volume');
        $log_prev = LogActual::where('tran_baseline_id', $baseline->id)->where('approval_tim_ut', 'approve')->orderBy('id', 'DESC')->first();
        if (isset($log_prev)) {
          $actual_progress = $log_prev->actual_progress;
        }
      }
      // $baseline = TranBaseline::where('id', $log->tran_baseline_id)->first();
      TranBaseline::where("id", $baseline->id)
        ->update([
          'approval_waspang' => $log->approval_waspang,
          'approval_tim_ut' => $log->approval_tim_ut,
          'approval_message' =>  $log->approval_message,
          'actual_progress' =>  $actual_progress,
          'progress_bobot' => $progress_bobot,
          'actual_volume' => $sumActualVolume,
          'actual_task' =>  'REJECTED',
          'waspang_by' => $log->waspang_by,
          'tim_ut_by' => $log->tim_ut_by,
        ]);
    } else if ($approval_waspang == 'approve' || $approval_ut == 'approve') {
      LogActual::where("id", $log->id)
        ->update([
          'approval_waspang' => $approval_waspang,
          'approval_tim_ut' => $approval_ut,
          'approval_message' =>  $request->approval_message,
          'actual_start' => $actual_start,
          'actual_finish' => $actual_finish,
          'actual_progress' =>  $actual_progress,
          'progress_bobot' => $progress_bobot,
          'actual_volume' =>  $actual_volume,
          'actual_durasi' => $actual_durasi,
          'waspang_by' => $waspangBy,
          'tim_ut_by' => $tim_utBy,
        ]);
      if ($baseline->activity_id >= 1 && $baseline->activity_id <= 20) {
        $sumActualVolume = LogActual::where("project_id", $baseline->project_id)->where('approval_waspang',  'approve')->where("tran_baseline_id", $baseline->id)->sum('actual_volume');
      }
      if ($baseline->activity_id == 19) {
        $tgl1 = $actual_finish; // pendefinisian tanggal awal
        $tgl2 = date('Y-m-d', strtotime('+7 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari   
        TranSupervisi::where("project_id", $baseline->project_id)
          ->update([
            'plan_golive' => $tgl2,
          ]);
      }
      if ($baseline->activity_id == 21) {
        $sumActualVolume = LogActual::where("project_id", $baseline->project_id)->where('approval_tim_ut',  'approve')->where("tran_baseline_id", $baseline->id)->sum('actual_volume');
        TranBaseline::where("project_id", $baseline->project_id)->where("activity_id", 22)
          ->update([
            'actual_start' => $actual_start,
            'actual_status' => 'belum',
            'actual_task' => 'NEED UPDATED',
            'actual_volume' => 1
          ]);
      }
      // UPDATE ACTUAL DI TRANSBASELINE    
      TranBaseline::where("id", $baseline->id)
        ->update([
          'approval_waspang' => $approval_waspang,
          'approval_tim_ut' => $approval_ut,
          'approval_message' =>  $request->approval_message,
          'actual_start' => $actual_start,
          'actual_finish' => $actual_finish,
          'actual_task' =>  $actual_task,
          'actual_progress' =>  $actual_progress,
          'progress_bobot' => $progress_bobot,
          'actual_volume' =>  $sumActualVolume,
          'actual_durasi' => $actual_durasi,
          'waspang_by' => $waspangBy,
          'tim_ut_by' => $tim_utBy,
        ]);

      //update dokumen di supervisi
      $posisi_doc = '';
      $progress_doc = '';
      if ($approval_ut == 'approve') {
        $status_doc = 'ADMINISTRASI';
        $posisi_doc = 'MITRA AREA';
        $progress_doc = 'PEMBUATAN DOC';
        $logAdministrasi = TranAdministrasi::create([
          'project_id' => $baseline->project_id,
          'status_doc' => $status_doc,
          'posisi_doc' => $posisi_doc,
          'progress_doc' => $progress_doc,
        ]);
        $logAdministrasi->save();
      }
      $today = date('Y-m-d');
      $plan_finish_const = $baseline->plan_finish;
      $sumPlanBobot = 0;

      $actual_progress_const = $actual_progress != 0 ? ($actual_progress * $baseline->bobot) / 100  : 0;
      $sum_selesai = TranBaseline::where("project_id", $baseline->project_id)->where("actual_progress", 100)->sum('bobot');
      $sum_belum = TranBaseline::where("project_id", $baseline->project_id)->whereBetween('actual_progress', [1, 99])->sum('progress_bobot');


      if ($baseline->bobot == $actual_progress_const) {
        $sumBase = TranBaseline::where("project_id", $baseline->project_id)->where("actual_progress", '>',  0)->sum('bobot');
        $actual_progress_const = $sumBase;
      } elseif ($baseline->bobot > $actual_progress_const) {
        $actual_progress_const = $supervisi->progress_actual + $actual_progress_const;
      }
      // CARI STATUS CONST
      if ($baseline->activity_id >= 1 && $baseline->activity_id <= 9) {
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
      }

      if ($baseline->activity_id >= 10 && $baseline->activity_id <= 19) {
        $cek_const = TranBaseline::select('actual_start, actual_finish')
          ->where('project_id', $baseline->project_id)
          ->whereBetween('activity_id', [10, 19])->count();
        $cek_const_actual = TranBaseline::select('actual_start, actual_finish')
          ->where('project_id', $baseline->project_id)
          ->whereNotNull('actual_start')
          ->whereBetween('activity_id', [10, 19])->count();
        if ($cek_const_actual == $cek_const) {
          $status_const = 'INSTALL DONE';
        }
      }
      if ($baseline->activity_id == 20) {
        $status_const = 'SELESAI CT';
      }
      if ($baseline->activity_id == 21) {
        $status_const = 'SELESAI UT';
      }

      TranSupervisi::where("project_id", $baseline->project_id)
        ->update([
          'status_const' => $status_const,
          'status_doc' => $status_doc,
          'posisi_doc' => $posisi_doc,
          'progress_doc' => $progress_doc,
          'status_const' => $status_const,
          'progress_actual' => $sum_selesai + $sum_belum,
          //'progress_plan' => $sumPlanBobot
        ]);
    }

    admin_success('Processed successfully.');

    return redirect()->back();
    //return redirect('/ped-panel/actual-generate?id=' . $baseline->project_id);
  }


  public function addAdministrasi(Content $content)
  {
    return $content
      ->title('Administrasi Activity')
      ->body(new addAdministrasi());
  }

  public function addWaspang(Request $request)
  {
    TranSupervisi::where("id", $request->id)
      ->update([
        'waspang_id' => $request->waspang_id
      ]);
    admin_success('Waspang Updated.');

    return redirect()->back();
  }

  public function addUt(Request $request)
  {
    TranSupervisi::where("id", $request->id)
      ->update([
        'tim_ut_id' => $request->tim_ut_id
      ]);
    admin_success('Tim UT Updated.');

    return redirect()->back();
  }
}
