<?php

namespace App\Admin\Controllers;

use App\Models\RefListActivity;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RefListActivityController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Referensi List Activity';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RefListActivity());
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('List activity', 'list_activity');
        });

        $grid->column('category_id', __('Kategori'))->using([
            '1' => '[001] Preparing',
            '2' => '[002] Material Delivery',
            '3' => '[003] Installasi & Test Comm',
            '4' => '[004] Closing',
           
        ], 'Unknown')->dot([
            '1' => 'danger',
            '2' => 'info',
            '3' => 'primary',
            '4' => 'success',
        ], 'warning');
        
        //$grid->column('bobot.name', __('bobot'));
        $grid->column('list_activity', __('List activity'));
        $grid->column('bobot_default', __('Bobot Default'));
        $grid->column('volume_default', __('Volume Default'));
        $grid->column('satuan', __('Satuan'));
     
        $grid->column('status', 'Active')->icon([
            0 => 'toggle-off',
            1 => 'toggle-on',
        ], $default = '');
       
        $grid->paginate(25);

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
        $show = new Show(RefListActivity::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('category_id', __('category_id'));
        $show->field('code', __('Code'));
        $show->field('status', __('Status'));
        $show->field('list_activity', __('List activity'));
       

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RefListActivity());
        $form->select('category_id', 'category_id')->options(['001' => '[001] Preparing', '002' => '[002] Material Delivery', '003' => '[003] Installasi & Test Comm', '004' => '[004] Closing']);
        $form->text('code', __('Code'));
      
        $form->radio('status',  __('Active'))->options(['0' => 'NO', '1'=> 'YES'])->default('1');
        $form->text('list_activity', __('List activity'));
        $form->number('bobot_default', __('Bobot Default'));
        $form->number('volume_default', __('Volume Default'))->default('0');
        $form->text('satuan', __('Satuan'));

        return $form;
    }
}
