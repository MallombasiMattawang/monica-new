<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\LogPlan;
use App\Models\MstProject;
use App\Models\TranBaseline;
use App\Models\TranSupervisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SupervisiController extends Controller
{
  public function index(Request $request)
  {

    middlewareCheck(['web', 'mitra', 'waspang', 'tim-ut']);

    $insight = TRUE;
   
    $insightsupervisi = "";

    $pageTitle  = 'Supervisi ' . activeGuard() . '';
    $breadcrumb = [
      'Data Project',
      'Supervisi'
    ];

    $where = '';

    $keyword = request()->input('keyword');
    if (!empty($keyword)) {
      $where .= "AND project_name LIKE '%$keyword%' ";
    }

    $skip  = $request->input('skip');
    $take  = "20";


    $user_id =  getUser()->id;
    if (activeGuard() == 'waspang') {
      $user = "waspang_id = $user_id ";
    } else if (activeGuard() == 'tim-ut') {
      $user = "tim_ut_id = $user_id ";
    } else {
      $user = "mitra_id = $user_id ";
    }

    $results = TranSupervisi::whereRaw("$user $where")
      ->skip($skip)
      ->take($take)
      ->orderBy('id', 'DESC')
      ->get();



    // return $results;

    $response = '';
    if ($request->ajax()) {

      $id = 1 + $skip;

      foreach ($results as $supervisi) {

        $status_const = ($supervisi->status_const) ? "$supervisi->status_const" : "BELUM ADA";
        $bg = '';
        $ssStatus = '';
        $response .= '
                 <div class="col-md-4 hello" id="' . $id++ . '">
                 <div class="card">
                 <div class="card-body">
                   <h6 class="mb-1"><a href="' . route('supervisi.detail', [$supervisi->id, Str::slug($supervisi->project_name)]) . '" class="color-600">' . $supervisi->project_name . '</a></h6>
                   <p class="text-muted">WITEL : ' . $supervisi->supervisi_witel->name . '</p>
                   
                   <div class="project-members mb-4">
                   <label class="me-2">Status :</label>
                     <span class="badge bg-success">' . $supervisi->supervisi_project->status_project . ' </span>
                     <label class="me-2">Const :</label>
                     <span class="badge bg-warning">' . $status_const . ' </span>
                     
                   </div>
                   <label class="small d-flex justify-content-between">Progress Plan ' . $supervisi->progress_plan . '% <span class="text-custom">100%</span></label>
                   <div class="progress mt-1" style="height: 3px;">
                     <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: ' . $supervisi->progress_plan . '%;"></div>
                   </div>
                   <br>
                   <label class="small d-flex justify-content-between">Progress Actual ' . $supervisi->progress_actual . '% <span class="text-custom">100%</span></label>
                   <div class="progress mt-1" style="height: 3px;">
                     <div class="progress-bar bg-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: ' . $supervisi->progress_actual . '%;"></div>
                   </div>
                 </div>
                 <div class="card-footer py-3 text-center">
                   <small>Start date: <strong>' . tgl_indo($supervisi->supervisi_project->start_date) . '</strong></small>
                   <span class="px-3">|</span>
                   <small>Finish date: <strong>' . tgl_indo($supervisi->supervisi_project->end_date) . '</strong></small>
                 </div>
               </div>
                </div>
                ';
      }



      return $response;
    }


    return view(
      'pengguna.pages.supervisi.index',
      compact('pageTitle', 'breadcrumb', 'insight', 'insightsupervisi')
    );
  }

  public function detail($id, $slug)
  {
    $profil = TranSupervisi::findOrFail($id);

    $pageTitle  = $profil->project_name;
    $breadcrumb = [
      'Supervisi',
      'Detail'
    ];
    return view(
      'pengguna.pages.supervisi.detail',
      compact('pageTitle', 'profil', 'breadcrumb')
    );
  }
}
