  <?php
  
  public function kurvaS($id)
  {
    $project = MstProject::where("id", $id)->first();
    $supervisi = TranSupervisi::where('project_id', $id)->first();
    // $lists = TranBaseline::where("project_id", $id)
    //     ->select('id', 'activity_id', 'bobot', 'plan_durasi', 'plan_start', 'plan_finish')
    //     ->get();
    $lists_asc_date = TranBaseline::where("project_id", $id)->orderBy('plan_finish', 'ASC')->get();
    $end_date_plan = TranBaseline::where("project_id", $id)->whereNotNull('plan_finish')->orderBy('plan_finish', 'Desc')->first();
    $end_date_actual = TranBaseline::where("project_id", $id)->whereNotNull('actual_finish')->orderBy('id', 'Desc')->first();

    $start = $project->start_date;
    $end_plan = $end_date_plan->plan_finish;
    $end_finish = 0;
    if ($end_date_actual) {
      $end_finish = $end_date_actual->actual_finish;
    }

    $end_today = date('Y-m-d'); //end dihari ini
    $end = $end_plan;
    if ($end_finish > $end_plan) {
      $end = $end_finish;
    }
    if ($supervisi->progress_actual < 100) {
      // $end = $end_today;
      $end = $end;
    }
    $sum_bobot_plan = LogPlan::where('project_id', $project->id)
      ->whereBetween('log_date', [$project->start_date, $start])
      ->sum('log_bobot');
    $sum_bobot_real = TranBaseline::where('project_id', $project->id)
      ->whereBetween('actual_start', [$project->start_date, $start])
      ->sum('bobot');

    $items = array();
    $i = 1;
    while (strtotime($start) <= strtotime($end)) {
      $items[] = ([
        'date' => $start,
        'bobot_plan' => number_format($sum_bobot_plan, 1, '.', ''),
        'bobot_real' => $sum_bobot_real
      ]);
      $start = date('Y-m-d', strtotime('+1 day', strtotime($start))); //looping tambah 1 date
      $sum_bobot_plan = LogPlan::where('project_id', $project->id)
        ->whereBetween('log_date', [$project->start_date, $start])
        ->sum('log_bobot');
      $sum_bobot_real = TranBaseline::where('project_id', $project->id)
        ->whereBetween('actual_start', [$project->start_date, $start])
        ->sum('bobot');
        if ($end_today < $start) {
          $sum_bobot_real = null;
        } else {
          $sum_bobot_real = number_format($sum_bobot_real, 1, '.', '');
        }
    }

    //make response JSON
    return response()->json([
      'status' => 'success',
      'data'   => $items,
      //'date' => $person,
    ], 200);
  }