<?php

namespace App\Admin\Controllers;

use App\Models\MstSmilleyNilai;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;
use App\Admin\Forms\importSap;
use App\Admin\Forms\importSmilley;
use App\Models\MstSmilleyVolume;
use Encore\Admin\Widgets\Tab;
use App\Imports\SmilleyNilaiImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class MstSmilleyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Tabel Smilley';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid_1 = new Grid(new MstSmilleyNilai());
        $grid_1->disableActions();

        $grid_1->disableCreateButton();
        $grid_1->disableRowSelector();
        $grid_1->disableExport();
        $grid_1->disableColumnSelector();
        $grid_1->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
                $filter->like('kt_lokasi', 'KT lokasi / Lop Site ID');
            });

            
        });
        $grid_1->tools(function ($tools) {
            $tools->append('<a href="/ped-panel/form-import-smilley" class="btn btn-default btn-sm"><i class="fa fa-download"></i>&nbsp;&nbsp; Import Tabel Smilley</a>');
        });

        $grid_1->column('id', __('Id'));
        $grid_1->column('kd_kontrak', __('Kd kontrak'));
        $grid_1->column('no_amdke', __('No amdke'));
        $grid_1->column('kd_wbs', __('Kd wbs'));
        $grid_1->column('kd_sgrup', __('Kd sgrup'));
        $grid_1->column('pk_owner', __('Pk owner'));
        $grid_1->column('kd_lokasi1', __('Kd lokasi1'));
        $grid_1->column('ubis_waslak', __('Ubis waslak'));
        $grid_1->column('unit_waslak', __('Unit waslak'));
        $grid_1->column('waslak_har', __('Waslak har'));
        $grid_1->column('ubis_owner', __('Ubis owner'));
        $grid_1->column('no_kontrak', __('No kontrak'));
        $grid_1->column('nm_proyek', __('Nm proyek'));
        $grid_1->column('tg_edc', __('Tg edc'));
        $grid_1->column('tg_toc', __('Tg toc'));
        $grid_1->column('nm_tematik', __('Nm tematik'));
        $grid_1->column('nm_witel', __('Nm witel'));
        $grid_1->column('nm_lokasi1', __('Nm lokasi1'));
        $grid_1->column('project_site_id', __('Project site id'));
        $grid_1->column('kt_lokasi', __('Kt lokasi'));
        $grid_1->column('site_alamat', __('Site alamat'));
        $grid_1->column('pro_plan', __('Pro plan'));
        $grid_1->column('pro_actual', __('Pro actual'));
        $grid_1->column('pro_bast', __('Pro bast'));
        $grid_1->column('status', __('Status'));
        $grid_1->column('tg_plan_start', __('Tg plan start'));
        $grid_1->column('tg_plan_finish', __('Tg plan finish'));
        $grid_1->column('tg_actual_start', __('Tg actual start'));
        $grid_1->column('no_ut', __('No ut'));
        $grid_1->column('tg_ut', __('Tg ut'));
        $grid_1->column('no_bast1', __('No bast1'));
        $grid_1->column('tg_baut', __('Tg baut'));
        $grid_1->column('ni_barang', __('Ni barang'));
        $grid_1->column('ni_jasa', __('Ni jasa'));
        $grid_1->column('ni_kontrak', __('Ni kontrak'));
        $grid_1->column('ni_bast1', __('Ni bast1'));
        $grid_1->column('no_po1', __('No po1'));
        $grid_1->column('no_po2', __('No po2'));
        $grid_1->column('no_po3', __('No po3'));
        $grid_1->column('no_po4', __('No po4'));
        $grid_1->column('no_po5', __('No po5'));
        $grid_1->column('nm_vendor', __('Nm vendor'));
        $grid_1->column('tg_bast1', __('Tg bast1'));
        $grid_1->fixColumns(4, -2);



        return $grid_1;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(MstSmilleyNilai::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('kd_kontrak', __('Kd kontrak'));
        $show->field('no_amdke', __('No amdke'));
        $show->field('kd_wbs', __('Kd wbs'));
        $show->field('kd_sgrup', __('Kd sgrup'));
        $show->field('pk_owner', __('Pk owner'));
        $show->field('kd_lokasi1', __('Kd lokasi1'));
        $show->field('ubis_waslak', __('Ubis waslak'));
        $show->field('unit_waslak', __('Unit waslak'));
        $show->field('waslak_har', __('Waslak har'));
        $show->field('ubis_owner', __('Ubis owner'));
        $show->field('no_kontrak', __('No kontrak'));
        $show->field('nm_proyek', __('Nm proyek'));
        $show->field('tg_edc', __('Tg edc'));
        $show->field('tg_toc', __('Tg toc'));
        $show->field('nm_tematik', __('Nm tematik'));
        $show->field('nm_witel', __('Nm witel'));
        $show->field('nm_lokasi1', __('Nm lokasi1'));
        $show->field('project_site_id', __('Project site id'));
        $show->field('kt_lokasi', __('Kt lokasi'));
        $show->field('site_alamat', __('Site alamat'));
        $show->field('pro_plan', __('Pro plan'));
        $show->field('pro_actual', __('Pro actual'));
        $show->field('pro_bast', __('Pro bast'));
        $show->field('status', __('Status'));
        $show->field('tg_plan_start', __('Tg plan start'));
        $show->field('tg_plan_finish', __('Tg plan finish'));
        $show->field('tg_actual_start', __('Tg actual start'));
        $show->field('no_ut', __('No ut'));
        $show->field('tg_ut', __('Tg ut'));
        $show->field('no_bast1', __('No bast1'));
        $show->field('tg_baut', __('Tg baut'));
        $show->field('ni_barang', __('Ni barang'));
        $show->field('ni_jasa', __('Ni jasa'));
        $show->field('ni_kontrak', __('Ni kontrak'));
        $show->field('ni_bast1', __('Ni bast1'));
        $show->field('no_po1', __('No po1'));
        $show->field('no_po2', __('No po2'));
        $show->field('no_po3', __('No po3'));
        $show->field('no_po4', __('No po4'));
        $show->field('no_po5', __('No po5'));
        $show->field('nm_vendor', __('Nm vendor'));
        $show->field('tg_bast1', __('Tg bast1'));
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
        $form = new Form(new MstSmilleyNilai());

        $form->text('kd_kontrak', __('Kd kontrak'));
        $form->text('no_amdke', __('No amdke'));
        $form->text('kd_wbs', __('Kd wbs'));
        $form->text('kd_sgrup', __('Kd sgrup'));
        $form->text('pk_owner', __('Pk owner'));
        $form->text('kd_lokasi1', __('Kd lokasi1'));
        $form->text('ubis_waslak', __('Ubis waslak'));
        $form->text('unit_waslak', __('Unit waslak'));
        $form->text('waslak_har', __('Waslak har'));
        $form->text('ubis_owner', __('Ubis owner'));
        $form->text('no_kontrak', __('No kontrak'));
        $form->text('nm_proyek', __('Nm proyek'));
        $form->text('tg_edc', __('Tg edc'));
        $form->text('tg_toc', __('Tg toc'));
        $form->text('nm_tematik', __('Nm tematik'));
        $form->text('nm_witel', __('Nm witel'));
        $form->text('nm_lokasi1', __('Nm lokasi1'));
        $form->text('project_site_id', __('Project site id'));
        $form->text('kt_lokasi', __('Kt lokasi'));
        $form->text('site_alamat', __('Site alamat'));
        $form->text('pro_plan', __('Pro plan'));
        $form->text('pro_actual', __('Pro actual'));
        $form->text('pro_bast', __('Pro bast'));
        $form->text('status', __('Status'));
        $form->text('tg_plan_start', __('Tg plan start'));
        $form->text('tg_plan_finish', __('Tg plan finish'));
        $form->text('tg_actual_start', __('Tg actual start'));
        $form->text('no_ut', __('No ut'));
        $form->text('tg_ut', __('Tg ut'));
        $form->text('no_bast1', __('No bast1'));
        $form->text('tg_baut', __('Tg baut'));
        $form->text('ni_barang', __('Ni barang'));
        $form->text('ni_jasa', __('Ni jasa'));
        $form->text('ni_kontrak', __('Ni kontrak'));
        $form->text('ni_bast1', __('Ni bast1'));
        $form->text('no_po1', __('No po1'));
        $form->text('no_po2', __('No po2'));
        $form->text('no_po3', __('No po3'));
        $form->text('no_po4', __('No po4'));
        $form->text('no_po5', __('No po5'));
        $form->text('nm_vendor', __('Nm vendor'));
        $form->text('tg_bast1', __('Tg bast1'));

        return $form;
    }

   
    public function formImport()
    {
        return Admin::content(function (Content $content) {

            // optional
            $content->header('TABLE SMILLEY');

            // optional
            $content->description('Import Table');

            // add breadcrumb since v1.5.7
            $content->breadcrumb(
                ['text' => 'List Smilley', 'url' => '/mst-smilleys'],
                ['text' => 'Import Tabel Smilley']
            );


            // Direct rendering view, Since v1.6.12
            $content->view('admin.modules.smilley.form-import', ['data' => 'foo']);
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
            Excel::import(new SmilleyNilaiImport, public_path('/uploads/temp_import/' . $nama_file));
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
