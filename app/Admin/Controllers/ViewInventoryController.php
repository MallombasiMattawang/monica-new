<?php

namespace App\Admin\Controllers;

use App\Exports\SupervisiExport;
use App\Models\TranOdp;
use App\Models\TranSupervisi;
use App\Models\ViewSupervisi;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ViewInventoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'View Inventory';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ViewSupervisi());
        $grid->column('id', __('ID'));
        $grid->column('tematik', __('tematik'));
        $grid->column('witel', __('witel'));
        $grid->column('sto', __('sto'));
        $grid->column('project_name', __('project_name'));
        $grid->column('mitra', __('mitra'));
        $grid->column('no_sp_telkom', __('no_sp_telkom'));

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
        $show = new Show(ViewSupervisi::findOrFail($id));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ViewSupervisi());

        return $form;
    }

    function list(Request $request) {
        return Admin::content(function (Content $content) use ($request) {
            $query = TranOdp::query();

            // Filter data berdasarkan keyword pencarian
            $search = $request->input('search');
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('project_name', 'like', "%$search%")
                        ->orWhere('project_name', 'like', "%$search%");
                });
            }

            // Ambil data dengan pagination
            $supervisis = $query->paginate(20);
            $content->body(view('admin.modules.inventory.list', [
                'supervisis' => $supervisis,
                'search' => $search,

            ]));
        });
    }

    //////////////////// PER SUPERVISI ///////////////////////////////
    // function list(Request $request) {
    //     return Admin::content(function (Content $content) use ($request) {
    //         $query = TranSupervisi::query();

    //         // Filter data berdasarkan keyword pencarian
    //         $search = $request->input('search');
    //         if (!empty($search)) {
    //             $query->where(function ($q) use ($search) {
    //                 $q->where('project_name', 'like', "%$search%")
    //                     ->orWhere('project_name', 'like', "%$search%");
    //             });
    //         }

    //         // Ambil data dengan pagination
    //         $supervisis = $query->whereIn('status_const', ['INSTALL DONE', 'SELESAI UT', 'SELESAI CT', 'REKON', 'SELESAI REKON', 'BAST-1'])
    //             ->paginate(20);
    //         $content->body(view('admin.modules.inventory.list', [
    //             'supervisis' => $supervisis,
    //             'search' => $search,

    //         ]));
    //     });
    // }

    public function export()
    {
        return Excel::download(new SupervisiExport, date('y-m-d-his-') . 'supervisi.xlsx');
    }
}
