<?php

namespace App\Admin\Controllers;

use App\Exports\SupervisiExport;
use App\Models\LogActual;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use App\Models\ViewSupervisi;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Maatwebsite\Excel\Facades\Excel;
use Encore\Admin\Controllers\AdminController;

class ViewSupervisiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'View Supervisi';



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

    protected function list(Request $request)
    {
        return Admin::content(function (Content $content) use ($request) {
            $query = ViewSupervisi::query();

            // Filter data berdasarkan keyword pencarian
            $search = $request->input('search');
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('project_name', 'like', "%$search%")
                        ->orWhere('project_name', 'like', "%$search%");
                });
            }

            // Ambil data dengan pagination
            $supervisis = $query->paginate(10);
            $content->body(view('admin.modules.supervisi.list', [
                'supervisis' => $supervisis,
                'search' => $search

            ]));
        });
    }

    public function getRemark(Request $request)
    {
        $project_id = $request->input('project_id');

        // Query Eloquent sesuai dengan kebutuhan Anda
        //$result = LogActual::where('project_id', $project_id)->get();

        // cek data sap
        //  $cek_email = User::select(DB::raw("CONCAT(first_name, ' ', last_name) AS full_name"))->where('name', $row->name_waspang)->value('email');
        // Mendapatkan data transaksi dari model
        $remarks = LogActual::where('project_id', $project_id)
            ->whereNotNull('actual_message')
            ->where('actual_message', '<>', '')->get();

        // Mengelompokkan transaksi berdasarkan tanggal
        $groupedRemarks = $remarks->groupBy(function ($remark) {
            return $remark->created_at->format('Y-m-d');
        });
        $row_remark = (!$remarks->last()) ? 'Tidak ditemukan remaks' : '';
        foreach ($groupedRemarks as $date => $remarks) {
            $row_remark .= '<br><b>' . tgl_indo($date) . "</b>: <br>";

            foreach ($remarks as $remark) {
                $row_remark .= "- <strong>" . trimActivity($remark->tran_baseline->list_activity) . " = " . $remark->actual_volume . " dari " . $remark->tran_baseline->volume . " " . $remark->tran_baseline->satuan .  " (" . $remark->actual_status . "</strong>)<br> &nbsp;&nbsp; <i>Catatan: " . $remark->actual_message . "</i><br>";
            }
        }
        $row_remark .= "<br>";

        return response()->json($row_remark);
    }

    public function getKendala(Request $request)
    {
        $project_id = $request->input('project_id');
        $kendala = LogActual::where('project_id', $project_id)
            ->whereNotNull('actual_kendala')
            ->where('actual_kendala', '<>', '')
            ->get();

        // Mengelompokkan transaksi berdasarkan tanggal
        $groupedKendala = $kendala->groupBy(function ($kendala) {
            return $kendala->created_at->format('Y-m-d');
        });
        $row_kendala = (!$kendala->last())  ?  'Tidak ditemukan kendala' : '';
        foreach ($groupedKendala as $date => $kendalas) {
            $row_kendala .= '<br><b>' . tgl_indo($date) . "</b>: <br>";
            foreach ($kendalas as $kendala) {
                $row_kendala .= '<p>- ' . $kendala->actual_kendala . '</p>';
            }

        }
        $row_kendala .= "<br>";

        return response()->json($row_kendala);
    }

    public function export()
    {
        return Excel::download(new SupervisiExport, date('y-m-d-his-') . 'supervisi.xlsx');
    }
}
