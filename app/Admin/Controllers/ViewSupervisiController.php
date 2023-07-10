<?php

namespace App\Admin\Controllers;

use App\Exports\SupervisiExport;
use App\Models\LogActual;
use App\Models\TranBaseline;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use App\Models\ViewSupervisi;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\DB;
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

        $tranBaseline = TranBaseline::where('tran_baseline.project_id', $project_id)
            ->select(
                DB::raw(
                    'tran_baseline.id,
                        tran_baseline.id,
                        tran_baseline.list_activity,
                        tran_baseline.volume,
                        tran_baseline.satuan,
                        (SELECT la.actual_start FROM log_actual la WHERE la.tran_baseline_id = log_actual.tran_baseline_id ORDER BY la.updated_at DESC LIMIT 1) as actual_start,
                        (SELECT la.actual_finish FROM log_actual la WHERE la.tran_baseline_id = log_actual.tran_baseline_id ORDER BY la.updated_at DESC LIMIT 1) as actual_finish,
                        (SELECT la.actual_message FROM log_actual la WHERE la.tran_baseline_id = log_actual.tran_baseline_id ORDER BY la.updated_at DESC LIMIT 1) as actual_message,
                        (SELECT la.actual_volume FROM log_actual la WHERE la.tran_baseline_id = log_actual.tran_baseline_id ORDER BY la.updated_at DESC LIMIT 1) as actual_volume,
                        (SELECT la.actual_status FROM log_actual la WHERE la.tran_baseline_id = log_actual.tran_baseline_id ORDER BY la.updated_at DESC LIMIT 1) as actual_status'
                ))
            ->join('log_actual', 'log_actual.tran_baseline_id', '=', 'tran_baseline.id')
            ->groupBy(
                'tran_baseline.id',
                'tran_baseline.list_activity',
                'log_actual.tran_baseline_id'
            )
            ->get();

        $array = [];
        foreach ($tranBaseline as $item) {
            $array[$item->actual_start][$item->actual_start][] = $item->toArray();
        }

        $fixed = array_values($array);

        for ($i = 0; $i < count($fixed); $i++) {
            if ($i > 0) {
                $keys = array_keys($fixed[$i]);
                $prev_keys = array_keys($fixed[$i-1]);
                foreach ($fixed[$i-1][reset($prev_keys)] as $item) {
                    $fixed[$i][reset($keys)][] = $item;
                }
            }
        }

        $result = [];
        foreach ($fixed as $item) {
            foreach ($item as $key => $i) {
                $sort = [];
                foreach ($i as $ikey => $isort) {
                    $sort[$ikey] = $isort['actual_start'];
                }

                array_multisort($i, SORT_ASC, $sort);
                $result[$key] = $i;
            }
        }
//
//
        foreach ($result as $date => $remarks) {
            $row_remark .= '<br><b>' . tgl_indo($date) . "</b>: <br>";
            foreach ($remarks as $remark) {
                $row_remark .= "- <strong>" . trimActivity($remark['list_activity']) . " = " . $remark['actual_volume'] . " dari " . $remark['volume'] . " " . $remark['satuan'] . " (" . $remark['actual_status'] . "</strong>)<br> &nbsp;&nbsp; <i>Catatan: " . $remark['actual_message'] . "</i><br>";
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
        $row_kendala = (!$kendala->last()) ? 'Tidak ditemukan kendala' : '';
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
}
