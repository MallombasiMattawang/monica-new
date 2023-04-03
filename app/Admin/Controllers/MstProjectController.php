<?php

namespace App\Admin\Controllers;

use App\Models\MstSap;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\MstWitel;
use Encore\Admin\Widgets;
use App\Models\MstProject;
use App\Admin\Forms\addPlan;
use App\Models\MstWaspangUt;
use App\Models\TranBaseline;
use Illuminate\Http\Request;
use App\Models\TranSupervisi;
use App\Admin\Actions\Restore;
use App\Imports\ProjectImport;
use App\Admin\Forms\AccProject;
use App\Models\RefListActivity;
use Encore\Admin\Facades\Admin;
use App\Models\TranAdministrasi;
use Encore\Admin\Layout\Content;
use Encore\Admin\Auth\Permission;
use App\Admin\Actions\Project\Acc;
use App\Admin\Forms\importProject;
use Illuminate\Support\Facades\DB;
use App\Admin\Actions\BatchRestore;
use App\Admin\Actions\Project\Plan;
use Maatwebsite\Excel\Facades\Excel;
use App\Admin\Actions\Post\Replicate;
use App\Admin\Forms\BaselineActivity;
use App\Admin\Actions\Project\Baseline;
use App\Admin\Actions\Project\ActualActivity;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;

class MstProjectController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TABLE PROJECT';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MstProject());
        $grid->model()->orderBy('id', 'desc');
        $grid->fixColumns(3, -1);

        if (Admin::user()->inRoles(['witel'])) {
            $grid->model()->where('witel_id', '=', Admin::user()->username);
            $grid->disableRowSelector();
        }

        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                if (\request('_scope_') == 'trashed') {
                    $batch->disableDelete();
                }
            });
            $tools->append('<a href="/ped-panel/form-import-project" class="btn btn-default btn-sm"><i class="fa fa-download"></i>  Import Project</a>');
        });

        $grid->batchActions(function ($batch) {
            if (\request('_scope_') == 'trashed') {
                $batch->add(new BatchRestore());
            }
        });
        $grid->actions(function ($actions) {
            $actions->disableEdit();
            if ($actions->row->status_project != 'USULAN') {
                $actions->disableDelete();
            }
            if (\request('_scope_') == 'trashed') {
                $actions->add(new Restore());
            }
        });
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            if (Admin::user()->inRoles(['administrator'])) {
                $filter->scope('trashed', 'Recycle Bin')->onlyTrashed();
            }

            $filter->column(1 / 2, function ($filter) {
                $filter->like('lop_site_id', 'LOP / SITE ID');
                $filter->in('status_project', 'STATUS PROJECT')->multipleSelect(['USULAN' => 'USULAN', 'DONE DRM' => 'DONE DRM', 'PELIMPAHAN' => 'PELIMPAHAN', 'PO' => 'PO/SP', 'DROP' => 'DROP']);
                $filter->like('witel_id', 'WITEL');
                $filter->like('mitra_id', 'MITRA');
            });

            $filter->column(1 / 2, function ($filter) {

                $filter->between('start_date', 'START DATE')->date();
                $filter->between('end_date', 'END DATE')->date();
            });
        });
        $grid->rows(function (Grid\Row $row) {
            if ($row->status_project == 'USULAN') {
                $row->setAttributes(['style' => 'color:red;']);
            }
        });
        //$grid->fixColumns(3, -2);
        $grid->column('tipe_project', __('TIPE PROJECT'))->width(200)->hide();
        $grid->column('tematik', __('TEMATIK'))->sortable();


        $grid->column('witel.name', __('WITEL'))->sortable();
        $grid->column('sto_id', __('STO'))->sortable();
        $grid->column('lop_site_id', __('LOP / SITE ID'))->sortable();
        $grid->column('odp_port', __('PORT'))->sortable();

        $grid->column('rab_total')->display(function ($rab_total) {
            return separator($rab_total);
        })->sortable();
        $grid->column('nilai_capex_per_port')->display(function ($nilai_capex_per_port) {
            return separator($nilai_capex_per_port);
        })->sortable();
        $grid->column('mitra.nama_mitra', __('MITRA'))->sortable();
        $grid->column('status_project', __('STATUS PROJECT'))->width(250)->sortable();
        $grid->column('start_date', __('START DATE'))->sortable();
        $grid->column('end_date', __('END DATE'))->sortable();


        Admin::style('                
          .table th {
            text-transform: uppercase;
            background-color: #ee99a0;            
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

        $data = MstProject::findOrFail($id);
        $supervisi = TranSupervisi::where('project_id', $id)->first();

        if ($data->status_project == 'DROP') {
            $color = 'bg-red';
        } elseif ($data->status_project == 'USULAN') {
            $color = 'bg-orange';
        } else {
            $color = 'bg-green';
        }
        return view('admin.modules.project.detail', [
            'data' => $data,
            'supervisi' => $supervisi,
            'color' => $color
        ]);
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = new Form(new MstProject());
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
        });

        $form->tab('Info', function (Form $form) {
            $form->hidden('id');
            $form->text('tipe_project', __('Tipe project'));
            $form->text('tematik', __('Tematik'));
            $form->text('nde_permintaan', __('Nde permintaan'));
            $form->text('perihal_nde', __('Perihal nde'));
            $form->date('tgl_nde', __('Tgl nde'));
            $form->currency('nilai_permintaan', __('Nilai permintaan'))->symbol('Rp.');
            
            if ($form->isEditing()) {
                $form->display('mitra_id', __('Mitra'));
            }

            $form->text('sto_id', __('Sto id'));
            $form->text('lop_site_id', __('Lop site id'));
        })->tab('Feeder', function (Form $form) {
            $form->number('feeder_ku_kap_12', __('Feeder ku kap 12'));
            $form->number('feeder_ku_kap_24', __('Feeder ku kap 24'));
            $form->number('feeder_ku_kap_48', __('Feeder ku kap 48'));
            $form->number('feeder_ku_kap_96', __('Feeder ku kap 96'));
            $form->number('feeder_kt_kap_24', __('Feeder kt kap 24'));
            $form->number('feeder_kt_kap_48', __('Feeder kt kap 48'));
            $form->number('feeder_kt_kap_96', __('Feeder kt kap 96'));
            $form->number('feeder_kt_kap_144', __('Feeder kt kap 144'));
            $form->number('feeder_kt_kap_288', __('Feeder kt kap 288'));
        })->tab('Dsitribusi', function (Form $form) {
            $form->number('distribusi_ku_kap_24_scpt', __('Distribusi ku kap 24 scpt'));
            $form->number('distribusi_ku_kap_12_scpt', __('Distribusi ku kap 12 scpt'));
            $form->number('distribusi_ku_kap_8_scpt', __('Distribusi ku kap 8 scpt'));
            $form->number('distribusi_kt_kap_24_scpt', __('Distribusi kt kap 24 scpt'));
            $form->number('distribusi_kt_kap_12_scpt', __('Distribusi kt kap 12 scpt'));
            $form->number('distribusi_kt_kap_8_scpt', __('Distribusi kt kap 8 scpt'));
        })->tab('ODP', function (Form $form) {
            $form->number('odp_odp_8', __('Odp odp 8'));
            $form->number('odp_odp_16', __('Odp odp 16'));
            $form->number('odp_spl_1_8', __('Odp spl 1 8'));
            $form->number('odp_spl_1_16', __('Odp spl 1 16'));
            $form->number('odp_port', __('Odp port'));
            $form->text('catuan_jenis', __('Catuan jenis'));
            $form->text('catuan_nama', __('Catuan nama'));
        })->tab('ODC', function (Form $form) {
            $form->number('odc_odc_48', __('Odc odc 48'));
            $form->number('odc_odc_96', __('Odc odc 96'));
            $form->number('odc_odc_144', __('Odc odc 144'));
            $form->number('odc_odc_288', __('Odc odc 288'));
            $form->number('odc_576', __('Odc 576'));
            $form->number('odc_total', __('Odc total'));
        })->tab('Summary & RAB', function (Form $form) {
            $form->number('panjang_feeder', __('Panjang feeder'));
            $form->number('panjang_dist', __('Panjang dist'));
            $form->number('tiang_baru', __('Tiang baru'));
            $form->number('jarak_ke_sto', __('Jarak ke sto'));
            $form->number('jml_home_pass', __('Jml home pass'));
            $form->currency('rab_material', __('Rab material'))->symbol('Rp.');
            $form->currency('rab_survey', __('Rab survey'))->symbol('Rp.');
            $form->currency('rab_total', __('Rab total'))->symbol('Rp.');
            $form->text('nilai_capex_per_port', __('Nilai capex per port'));
        });

        return $form;
    }


    public function formImport()
    {
        return Admin::content(function (Content $content) {

            // optional
            $content->header('TABLE PROJECT');

            // optional
            $content->description('Import Table Project');

            // add breadcrumb since v1.5.7
            $content->breadcrumb(
                ['text' => 'List Project', 'url' => '/mst-projects'],
                ['text' => 'Import Project']
            );


            // Direct rendering view, Since v1.6.12
            $content->view('admin.modules.project.form-import', ['data' => 'foo']);
        });
    }

    public function submitImport(Request $request)
    {
        $validatedData = $request->validate(
            [
                'file' => 'required|mimes:xlsx|max:25000',
            ],
            [
                'file.required' => 'File tidak boleh kosong.',
                'file.mimes' => 'File harus berupa format Excel (.xlsx).',
                'file.max' => 'Ukuran file tidak boleh lebih dari 25 MB.',
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
            Excel::import(new ProjectImport, public_path('/uploads/temp_import/' . $nama_file));
            admin_success('Processed import successfully.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = array();

            foreach ($failures as $failure) {
                $errors[] = 'kesalahan pada Baris ke- ' . $failure->row() . ': ' . implode(',', $failure->errors());
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

    public function submitPlayProject(Request $request)
    {
        $request->validate(
            [
                'status_project' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
            ],
            [
                'status_project' => 'status project tidak boleh kosong.',
                'start_date' => 'Start Project tidak boleh kosong',
                'end_date.after' => 'Finish project tidak boleh kurang dari Start Project.',
            ]
        );
        $id = $request->id;
        $data = MstProject::findOrFail($id);
        $data->status_project = $request->status_project;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->save();

        // Supervisikan
        $check = TranSupervisi::where('project_id', '=', $id)->exists();
        if ($check == 0) {
            $supervisi = TranSupervisi::create([
                'project_id' => $id,
                'project_name' => $data->lop_site_id,
                'mitra_id' => $data->mitra->id,
                'witel_id' =>  $data->witel->id,
                'task' => 'CREATE BASELINE',
                'plan_nilai' => $data->rab_total,
                'plan_port' => $data->odp_port,
            ]);
            $supervisi->save();
        } else {
            TranSupervisi::where("project_id", $id)
                ->update([
                    'project_name' => $data->lop_site_id,
                    'mitra_id' => $data->mitra->id,
                    'witel_id' =>  $data->witel->id,
                    'task' => 'CREATE BASELINE',
                    'plan_nilai' => $data->rab_total,
                    'plan_port' => $data->odp_port,
                ]);
        }

        //Administrasikan
        $check = TranAdministrasi::where('project_id', '=', $id)->exists();
        if ($check == 0) {
            $administrasi = TranAdministrasi::create([
                'witel_id' =>  $data->witel->id,
                'project_id' => $id,
                'mitra_id' => $data->mitra->id,
            ]);
            $administrasi->save();
        } else {
            TranAdministrasi::where("project_id", $id)
                ->update([
                    'witel_id' =>  $data->witel->id,
                    'mitra_id' => $data->mitra->id,
                ]);
        }

        admin_success('Processed updated successfully, project ' . $data->lop_site_id . ' berhasil di- Supervisikan');
        return redirect()->back();
    }

    public function submitDropProject(Request $request)
    {
        $request->validate(
            [
                'status_project' => 'required'
            ],
            [
                'status_project' => 'status project tidak boleh kosong.'
            ]
        );
        $id = $request->id;
        $data = MstProject::findOrFail($id);
        $data->status_project = 'DROP';
        $data->save();

        admin_success('Processed Drop successfully, project ' . $data->lop_site_id . ' berhasil di- DROP');
        return redirect('ped-panel/mst-projects');
    }
}
