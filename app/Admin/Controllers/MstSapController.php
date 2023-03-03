<?php

namespace App\Admin\Controllers;

use App\Models\MstSap;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Forms\importSap;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\AdminController;
use App\Imports\SapImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class MstSapController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TABEL REPORTING SAP';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MstSap());
        $grid->disableActions();

        $grid->disableCreateButton();

        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
                $filter->like('name', 'Name Project');
                $filter->like('witel', 'WITEL');
            });

            $filter->column(1 / 2, function ($filter) {
                $filter->in('status_sap', 'STATUS SAP')->multipleSelect(['GR' => 'GR',  'PO' => 'PO', 'SP' => 'SP']);
            });
        });

        $grid->disableRowSelector();

        $grid->disableColumnSelector();

        $grid->tools(function ($tools) {
            $tools->append('<a href="/ped-panel/form-import-sap" class="btn btn-default btn-sm"><i class="fa fa-download"></i>&nbsp;&nbsp;  Import Reporting SAP</a>');
        });

        $grid->disableExport();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->disableEdit();
            $actions->disableDelete();
        });

        $grid->column('id', __('Id'));
        $grid->column('baru_co', __('Baru co'));
        $grid->column('cfu', __('Cfu'));
        $grid->column('flag', __('Flag'));
        $grid->column('uraian_wbs', __('Uraian wbs'));
        $grid->column('comm_release', __('Comm release'));
        $grid->column('pay_release', __('Pay release'));
        $grid->column('wbs_element', __('Wbs element'));
        $grid->column('purchasing_doc', __('Purchasing doc'));
        $grid->column('kontrak', __('Kontrak'));
        $grid->column('proses', __('Proses'));
        $grid->column('ref_doc_no', __('Ref doc no'));
        $grid->column('item', __('Item'));
        $grid->column('cost_elem', __('Cost elem'));
        $grid->column('name', __('Name'));
        $grid->column('ses_pelimpahan', __('Ses pelimpahan'));
        $grid->column('witel', __('Witel'));
        $grid->column('id_vendor', __('Id vendor'));
        $grid->column('vendor', __('Vendor'));
        $grid->column('ta_non_ta', __('Ta non ta'));
        $grid->column('user', __('User'));
        $grid->column('doc_date', __('Doc date'));
        $grid->column('nilai_pr_po_gr', __('Nilai pr po gr'));
        $grid->column('value_tcur', __('Value tcur'));
        $grid->column('status_pr', __('Status pr'));
        $grid->column('status_po', __('Status po'));
        $grid->column('status_gr', __('Status gr'));
        $grid->column('debit_date', __('Debit date'));
        $grid->column('keterangan', __('Keterangan'));
        $grid->column('achv_progi', __('Achv progi'));
        $grid->column('tematik', __('Tematik'));
        $grid->column('status_sap', __('Status sap'));
        $grid->fixColumns(4, -1);
        // Admin::style('.table {
        //     #background: #ee99a0;
        //     border-radius: 0.2rem;
        //     width: 100%;
        //     padding-bottom: 1rem;
        //     color: #212529;
        //     margin-bottom: 0;
        //   }
        //   .table th:nth-child(15),
        //   .table td:nth-child(15) {
        //     white-space: nowrap;
        //     position: sticky;
        //     left: 0;
        //     background-color: #ffffd5;
        //     color: #373737;
        //   }
        //   .table th:nth-child(32) {
        //     position: sticky;
        //     right: 0;
        //     background-color: #ffffd5;
        //     color: #373737;
        //   }
        //   .table td:nth-child(32) {           
        //     position: sticky;
        //     background-color: #ffffd5;
        //     right: 0;            
        //     color: #373737;
        //   }

        //   .table th {
        //     text-transform: uppercase;
        //     white-space: nowrap;
        //     background-color: #ffffd5;
        //   }
        //   .table td {

        //     white-space: nowrap;

        //   }

        //   ');


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
        $show = new Show(MstSap::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('baru_co', __('Baru co'));
        $show->field('cfu', __('Cfu'));
        $show->field('flag', __('Flag'));
        $show->field('uraian_wbs', __('Uraian wbs'));
        $show->field('comm_release', __('Comm release'));
        $show->field('pay_release', __('Pay release'));
        $show->field('wbs_element', __('Wbs element'));
        $show->field('purchasing_doc', __('Purchasing doc'));
        $show->field('kontrak', __('Kontrak'));
        $show->field('proses', __('Proses'));
        $show->field('ref_doc_no', __('Ref doc no'));
        $show->field('item', __('Item'));
        $show->field('cost_elem', __('Cost elem'));
        $show->field('name', __('Name'));
        $show->field('ses_pelimpahan', __('Ses pelimpahan'));
        $show->field('witel', __('Witel'));
        $show->field('id_vendor', __('Id vendor'));
        $show->field('vendor', __('Vendor'));
        $show->field('ta_non_ta', __('Ta non ta'));
        $show->field('user', __('User'));
        $show->field('doc_date', __('Doc date'));
        $show->field('nilai_pr_po_gr', __('Nilai pr po gr'));
        $show->field('value_tcur', __('Value tcur'));
        $show->field('status_pr', __('Status pr'));
        $show->field('status_po', __('Status po'));
        $show->field('status_gr', __('Status gr'));
        $show->field('debit_date', __('Debit date'));
        $show->field('keterangan', __('Keterangan'));
        $show->field('achv_progi', __('Achv progi'));
        $show->field('tematik', __('Tematik'));
        $show->field('status_sap', __('Status sap'));
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
        $form = new Form(new MstSap());

        $form->text('baru_co', __('Baru co'));
        $form->text('cfu', __('Cfu'));
        $form->text('flag', __('Flag'));
        $form->text('uraian_wbs', __('Uraian wbs'));
        $form->text('comm_release', __('Comm release'));
        $form->text('pay_release', __('Pay release'));
        $form->text('wbs_element', __('Wbs element'));
        $form->text('purchasing_doc', __('Purchasing doc'));
        $form->text('kontrak', __('Kontrak'));
        $form->text('proses', __('Proses'));
        $form->text('ref_doc_no', __('Ref doc no'));
        $form->text('item', __('Item'));
        $form->text('cost_elem', __('Cost elem'));
        $form->text('name', __('Name'));
        $form->text('ses_pelimpahan', __('Ses pelimpahan'));
        $form->text('witel', __('Witel'));
        $form->text('id_vendor', __('Id vendor'));
        $form->text('vendor', __('Vendor'));
        $form->text('ta_non_ta', __('Ta non ta'));
        $form->text('user', __('User'));
        $form->text('doc_date', __('Doc date'));
        $form->text('nilai_pr_po_gr', __('Nilai pr po gr'));
        $form->text('value_tcur', __('Value tcur'));
        $form->text('status_pr', __('Status pr'));
        $form->text('status_po', __('Status po'));
        $form->text('status_gr', __('Status gr'));
        $form->text('debit_date', __('Debit date'));
        $form->text('keterangan', __('Keterangan'));
        $form->text('achv_progi', __('Achv progi'));
        $form->text('tematik', __('Tematik'));
        $form->text('status_sap', __('Status sap'));

        return $form;
    }

    public function formImport()
    {
        return Admin::content(function (Content $content) {

            // optional
            $content->header('TABLE REPORT SAP');

            // optional
            $content->description('Import Table');

            // add breadcrumb since v1.5.7
            $content->breadcrumb(
                ['text' => 'List SAP', 'url' => '/mst-saps'],
                ['text' => 'Import Tabel SAP']
            );


            // Direct rendering view, Since v1.6.12
            $content->view('admin.modules.sap.form-import', ['data' => 'foo']);
        });
    }

    public function submitImport(Request $request)
    {
        $validatedData = $request->validate(
            [
                'file' => 'required|mimes:xlsx|max:5000',
            ],
            [
                'file.required' => 'File tidak boleh kosong.',
                'file.mimes' => 'File harus berupa format Excel (.xlsx).',
                'file.max' => 'Ukuran file tidak boleh lebih dari 5 MB.',
            ]
        );

        // Proses penyimpanan file jika sudah valid
        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_import di dalam folder public
        $file->move('uploads/temp_import', $nama_file);

        try {
            Excel::import(new SapImport, public_path('/uploads/temp_import/' . $nama_file));
            admin_success('Processed import successfully.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = array();

            foreach ($failures as $failure) {
                $errors[] = 'Baris ' . $failure->row() . ': ' . implode(',', $failure->errors());
            }
            admin_error('Processed import gagal,', $errors);
        } catch (\Exception $e) {
            admin_error('Processed import gagal, Format excel tidak sesuai');
        }

        // Hapus file Excel
        $file_path = public_path('/uploads/temp_import/' . $nama_file);
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        return redirect()->back();
    }
}
