<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\LogActual;
use Encore\Admin\Facades\Admin;
use App\Admin\Actions\Project\Plan;
use App\Admin\Actions\Project\Actual;
use App\Admin\Actions\Project\Approval;
use Encore\Admin\Controllers\AdminController;

class LogActualController extends AdminController
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
        if (Admin::user()->inRoles(['mitra'])) {
            $log = '';
            if (isset($_GET['log'])) {
                $log = $_GET['log'];
                //$grid->model()->where('tran_baseline_id', '=', $log);
                $grid->model()->join('tran_supervisi', 'log_actual.project_id', '=', 'tran_supervisi.project_id')->where('tran_supervisi.mitra_id', '=', Admin::user()->id)->where('log_actual.tran_baseline_id', '=', $log);
            } else {
                $grid->model()->join('tran_supervisi', 'log_actual.project_id', '=', 'tran_supervisi.project_id')->where('tran_supervisi.mitra_id', '=', Admin::user()->id);
            }
           
        }
        if (Admin::user()->inRoles(['waspang'])) {
            $log = '';
            if (isset($_GET['log'])) {
                $log = $_GET['log'];
                //$grid->model()->where('tran_baseline_id', '=', $log);
                $grid->model()->join('tran_supervisi', 'log_actual.project_id', '=', 'tran_supervisi.project_id')->where('tran_supervisi.waspang_id', '=', Admin::user()->id)->where('log_actual.tran_baseline_id', '=', $log);
            } else {
                $grid->model()->join('tran_supervisi', 'log_actual.project_id', '=', 'tran_supervisi.project_id')
                    ->where('tran_supervisi.waspang_id', '=', Admin::user()->id);
            }
        }
        $grid->disableActions();
        $grid->disableRowSelector();
        $grid->disableCreateButton();
        $grid->fixColumns(3, -3);

        $grid->column('project.lop_site_id', __('Project id'));
        $grid->column('tran_baseline.list_activity', __('Tran baseline id'));
        $grid->column('tran_baseline.volume', __('Volume Kontrak'));

        $grid->column('actual_volume', __('Actual volume'));

        $grid->column('actual_progress')->display(function ($actual_progress) {
            $actual_progress =  Round($actual_progress, 2);
            if ($actual_progress == 100) {
                return "<span style='color:green'>$actual_progress %</span>";
            } else {
                return "<span style='color:blue'>$actual_progress %</span>";
            }
        });
        //$grid->column('actual_evident')->image();
        // $grid->column('actual_evident')->modal('Evident', function ($actual_evident) {
           
                
        //             return "<img class='img-responsive' src='/uploads/$actual_evident->actual_evident'>";
            
            
        // });
        $grid->column('actual_evident')->display(function ($actual_evident) {
            
            return '<a href="/uploads/'.$actual_evident.'" target="_blank"><img style="max-width:50px;max-height:50px" class="img img-thumbnail" src="/uploads/'.$actual_evident.'" alt="evident"> </a>';
            
        });
        $grid->column('actual_status')->display(function ($actual_status) {
            if ($actual_status == 'belum') {
                $display = "<span style='color:red'>$actual_status</span>";
            } else {
                $display = "<span style='color:green'>$actual_status</span>";
            }
            return $display;
        });


        $grid->column('approval_waspang')->display(function ($actual_status) {
            if ($actual_status == 'approve') {
                $display = "<span style='color:green'>$actual_status</span>";
            } else {
                $display = "<span style='color:red'>$actual_status</span>";
            }
            return $display;
        });

        $grid->column('approval_tim_ut')->display(function ($actual_status) {
            if ($actual_status == 'approve') {
                $display = "<span style='color:green'>$actual_status</span>";
            } else {
                $display = "<span style='color:red'>$actual_status</span>";
            }
            return $display;
        });

        $grid->column('approval_message', __('Catatan'));

        $grid->column('actual_start', __('Actual start'));
        $grid->column('actual_finish', __('Actual finish'));

        //$grid->column('supervisi_status', __('Supervisi status'));

       
        $grid->column('project_id', 'Action')->display(function ($project_id) {

            return "<a href='actual-generate?id=$project_id' class='btn btn-info'> View </a>";
        });
        Admin::style('                
        .table th {
          text-transform: uppercase;
          background-color: #ee99a0;
          white-space: nowrap;
        }');


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
        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableList();
                $tools->disableDelete();
            });;
        $show->field('id', __('Id'));
        $show->field('project_id', __('Project id'));
        $show->field('tran_baseline_id', __('Tran baseline id'));

        $show->field('actual_volume', __('Actual volume'));
        $show->field('actual_progress', __('Actual progress'));
        $show->field('actual_status', __('Actual status'));
        $show->field('actual_evident', __('Actual evident'))->image();
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
}
