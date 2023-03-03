<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\LogActual;
use App\Models\MstProject;
use App\Models\TranBaseline;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\AdminController;

class TranLogActivityController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'LogActual';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LogActual());

        $grid->column('id', __('Id'));
        $grid->column('project_id', __('Project id'));
        $grid->column('tran_baseline_id', __('Tran baseline id'));
        $grid->column('activity_id', __('Activity id'));
        $grid->column('actual_volume', __('Actual volume'));
        $grid->column('actual_progress', __('Actual progress'));
        $grid->column('actual_status', __('Actual status'));
        $grid->column('actual_evident', __('Actual evident'));
        $grid->column('actual_message', __('Actual message'));
        $grid->column('approval_waspang', __('Approval waspang'));
        $grid->column('approval_tim_ut', __('Approval tim ut'));
        $grid->column('approval_message', __('Approval message'));
        $grid->column('actual_start', __('Actual start'));
        $grid->column('actual_finish', __('Actual finish'));
        $grid->column('actual_durasi', __('Actual durasi'));
        $grid->column('supervisi_status', __('Supervisi status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(LogActual::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('project_id', __('Project id'));
        $show->field('tran_baseline_id', __('Tran baseline id'));
        $show->field('activity_id', __('Activity id'));
        $show->field('actual_volume', __('Actual volume'));
        $show->field('actual_progress', __('Actual progress'));
        $show->field('actual_status', __('Actual status'));
        $show->field('actual_evident', __('Actual evident'));
        $show->field('actual_message', __('Actual message'));
        $show->field('approval_waspang', __('Approval waspang'));
        $show->field('approval_tim_ut', __('Approval tim ut'));
        $show->field('approval_message', __('Approval message'));
        $show->field('actual_start', __('Actual start'));
        $show->field('actual_finish', __('Actual finish'));
        $show->field('actual_durasi', __('Actual durasi'));
        $show->field('supervisi_status', __('Supervisi status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new LogActual());

        $form->number('project_id', __('Project id'));
        $form->number('tran_baseline_id', __('Tran baseline id'));
        $form->number('activity_id', __('Activity id'));
        $form->text('actual_volume', __('Actual volume'));
        $form->text('actual_progress', __('Actual progress'));
        $form->text('actual_status', __('Actual status'));
        $form->textarea('actual_evident', __('Actual evident'));
        $form->textarea('actual_message', __('Actual message'));
        $form->text('approval_waspang', __('Approval waspang'));
        $form->text('approval_tim_ut', __('Approval tim ut'));
        $form->textarea('approval_message', __('Approval message'));
        $form->text('actual_start', __('Actual start'));
        $form->text('actual_finish', __('Actual finish'));
        $form->text('actual_durasi', __('Actual durasi'));
        $form->text('supervisi_status', __('Supervisi status'));

        return $form;
    }

    public function logActivity(Content $content)
  {
    $id = $_GET['log'];
    
    $log_cek = LogActual::where("tran_baseline_id", $id)->first();
    $project = MstProject::where("id", $log_cek->project_id)->first();
    $baseline = TranBaseline::where("id", $id)->first();
    $logs = LogActual::where("tran_baseline_id", $id)->get();
    
    return $content
      ->title('Log Activity Project')
      ->body(view('admin.modul_log.index', [
        'project' => $project,
        'baseline' => $baseline,
        'logs' => $logs,
      ]));
  }
}
