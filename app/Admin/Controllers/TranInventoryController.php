<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Project\Odp;
use App\Models\MstMitra;
use App\Models\MstWitel;
use App\Models\TranOdp;
use App\Models\TranSupervisi;
//use Illuminate\Support\Facades\Request;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;
use Illuminate\Http\Request;

class TranInventoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Data Inventory';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new TranSupervisi());
        $grid->model()->whereIn('status_const', ['INSTALL DONE', 'SELESAI UT', 'SELESAI CT', 'REKON', 'SELESAI REKON', 'BAST-1']);
        //$grid->model()->join('tran_baseline', 'tran_supervisi.project_id', '=', 'tran_baseline.project_id')->where('tran_baseline.activity_id', '=',  19)->where('tran_baseline.actual_finish', '>',  0);
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->actions(function ($actions) {

            $actions->add(new Odp);
            $actions->disableEdit();
            $actions->disableDelete();
            $actions->disableView();
        });
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();

            $filter->column(1 / 2, function ($filter) {
                $filter->like('project_name', 'LOP / SITE ID');
                $filter->in('supervisi_project.tematik', 'TEMATIK')->multipleSelect(['PT3' => 'PT3', 'PT2' => 'PT2', 'NODE-B' => 'NODE-B', 'OLO' => 'OLO', 'HEM' => 'HEM', 'ISP' => 'ISP', 'FTTH 2022' => 'FTTH 2022']);
                $filter->in('witel_id', 'WITEL')->multipleSelect(
                    MstWitel::join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
                        ->where('admin_role_users.role_id', '2')->pluck('name', 'id')
                );
                $filter->in('mitra_id', 'MITRA')->multipleSelect(
                    MstMitra::pluck('nama_mitra', 'id')
                );
                $filter->in('status_gl_sdi', 'STATUS GL SDI')->multipleSelect([
                    'NO DATA' => 'NO DATA',
                    'VALIDASI ABD' => 'VALIDASI ABD',
                    'DRAWING' => 'DRAWING',
                    'INVENTORY' => 'INVENTORY',
                    'TERMINASI UIM' => 'TERMINASI UIM',
                    'GOLIVE PARSIAL' => 'GOLIVE PARSIAL',
                    'GOLIVE' => 'GOLIVE',
                    'KENDALA' => 'KENDALA',
                ]);
            });

            $filter->column(1 / 2, function ($filter) {

                $filter->between('plan_golive', 'PLAN GOLIVE')->date();
                $filter->between('real_golive', 'REAL GOLIVE')->date();
            });
        });
        // $grid->fixColumns(2, -1);
        $grid->column('supervisi_project.tematik', __('TEMATIK'));
        $grid->column('supervisi_project.witel_id', __('WITEL'));
        $grid->column('supervisi_project.sto_id', __('STO'));
        $grid->column('project_name', __('LOP/SITE ID'))->limit(30);
        //$grid->column('status_gl_sdi', __('Status gl sdi'));
        $grid->column('status_gl_sdi', 'Status gl sdi')->display(function ($status_gl_sdi, $column) {

            if ($this->status_gl_sdi != null) {
                return $status_gl_sdi;
            } else {
                return "NO DATA";
            }
        });
        $grid->column('ket_gl_sdi', __('KET GL SDI'));
        $grid->column('status_abd', __('STATUS ABD'));
        $grid->column('id_sw', __('ID SW'));
        $grid->column('id_imon', __('ID IMON'));
        // $grid->column('odp_8', __('Odp 8'));
        $grid->column('odp_8', 'ODP 8')->modal(function ($model) {

            $comments = $model->namaOdp()->where('jenis_odp', 'ODP 8')->take(100)->get()->map(function ($comment) {
                return $comment->only(['nama_odp', 'jenis_odp']);
            });

            return new Table(['Nama ODP', 'Jenis ODP'], $comments->toArray());
        });
        $grid->column('odp_16', 'ODP 16')->modal(function ($model) {

            $comments = $model->namaOdp()->where('jenis_odp', 'ODP 16')->take(100)->get()->map(function ($comment) {
                return $comment->only(['nama_odp', 'jenis_odp']);
            });

            return new Table(['Nama ODP', 'Jenis ODP'], $comments->toArray());
        });

        $grid->column('odp_port', __('Odp port'));

        $grid->column('plan_golive', __('Plan golive'));
        $grid->column('real_golive', __('Real golive'));

        Admin::style('.table {
            #background: #ee99a0;
            border-radius: 0.2rem;
            width: 100%;
            padding-bottom: 1rem;
            color: #212529;
            margin-bottom: 0;
          }
          .table th {
            text-transform: uppercase;
            white-space: nowrap;
            background-color: #ffffd5;
          }');
        $grid->fixColumns(0, -1);
        //     Admin::script('
        //   $("form").on( "submit", function( event ) {
        //          // $.admin.reload();
        //     $(".modal").modal("hide");
        // });
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
        $kode_odp = '';
        $start = 0;
        $finish = 0;
        if (isset($_GET['kode_odp'])) {
            $kode_odp = $_GET['kode_odp'];
        }
        if (isset($_GET['start'])) {
            $start = $_GET['start'];
        }
        if (isset($_GET['finish'])) {
            $finish = $_GET['finish'];
        }

        if ($start > $finish) {
            admin_error('Generate gagal, Pastikan start tidak lebih besar dari finish');
            admin_toastr('Pastikan start tidak lebih besar dari finish', 'danger');
            return back();
        }

        //$data = MstProject::findOrFail($id);

        $supervisi = TranSupervisi::where('id', $id)->first();
        $listOdp = TranOdp::where('supervisi_id', $id)->get();
        return view('admin.modules.inventory.generate-odp', [
            'listOdp' => $listOdp,
            'supervisi' => $supervisi,
            'kode_odp' => $kode_odp,
            'start' => $start,
            'finish' => $finish,
        ]);
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TranSupervisi());
        $form->tools(function (Form\Tools$tools) use ($form) {
            $tools->disableDelete();
            //$tools->add('<a href="/ped-panel/tran-inventory/' . $form->id . '" class="btn btn-sm btn-success"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Generate ODP</a>');

            $tools->disableView();
            //$tools->disableList();

        });
        $form->tab('Update Inventory', function (Form $form) {
            $form->hidden('id');
            $form->text('project_name', __('LOP SITE ID'))->readonly();
            $form->select('status_gl_sdi', __('STATUS GL SDI'))
                ->options([
                    'NO DATA' => 'NO DATA',
                    'VALIDASI ABD' => 'VALIDASI ABD',
                    'DRAWING' => 'DRAWING',
                    'INVENTORY' => 'INVENTORY',
                    'TERMINASI UIM' => 'TERMINASI UIM',
                    'GOLIVE' => 'GOLIVE',
                ])->default('NO DATA');
            $form->textarea('ket_gl_sdi', __('KET GL SDI')); //->help('(JIKA STATUS GL nya : KENDALA)');

            $form->select('status_abd', __('STATUS ABD'))
                ->options([
                    'NO ABD' => 'NO ABD',
                    'TIDAK VALID' => 'TIDAK VALID',
                    'VALID-4' => 'VALID-4',
                    'BA VALID' => 'BA VALID',

                ])->default('NO ABD');
            $form->text('id_sw', __('ID SW'));
            $form->text('id_imon', __('ID IMON'));

            $form->date('plan_golive', __('PLAN GOLIVE'));
            $form->date('real_golive', __('REAL GOLIVE'))->readonly()->help('(Tanggal GOLIVE diambil dari "STATUS GL SDI diupdate menjadi GOLIVE")');

        })->tab('Registrasi ODP', function (Form $form) {
            $form->hasMany('namaOdp', 'Daftar ODP Inventory', function (Form\NestedForm$form) {
                $form->text('nama_odp', 'Nama ODP');
                $form->select('jenis_odp', 'Jenis ODP')->options(['ODP 8' => 'ODP 8', 'ODP 16' => 'ODP 16']);
                $form->select('status_go_live', __('STATUS GOLIVE ODP'))
                    ->options([
                        'NO DATA' => 'NO DATA',
                        'VALIDASI ABD' => 'VALIDASI ABD',
                        'DRAWING' => 'DRAWING',
                        'INVENTORY' => 'INVENTORY',
                        'TERMINASI UIM' => 'TERMINASI UIM',
                        'GOLIVE' => 'GOLIVE',
                    ])->default('NO DATA');
                $form->select('kendala', __('KENDALA'))
                    ->options([
                        'Need Port OLT' => 'Need Port OLT',
                        'Need Mini OLT' => 'Need Mini OLT',
                        'Core Feeder Unspec' => 'Core Feeder Unspec',
                        'Core Feeder Habis' => 'Core Feeder Habis',
                        'Mancore Not Valid' => 'Mancore Not Valid',
                        'Belum CT' => 'Belum CT',
                        'Belum Valins' => 'Belum Valins',
                    ]);
                $form->select('status_abd', __('STATUS ABD'))
                    ->options([
                        'NO ABD' => 'NO ABD',
                        'TIDAK VALID' => 'TIDAK VALID',
                        'VALID-4' => 'VALID-4',
                        'BA VALID' => 'BA VALID',

                    ])->default('NO ABD');
            });
        });

        // callback after save
        $form->saved(function (Form $form) {
            $countOdp8 = TranOdp::where("supervisi_id", $form->id)->where('jenis_odp', '=', 'ODP 8')->count();
            $countOdp16 = TranOdp::where("supervisi_id", $form->id)->where('jenis_odp', '=', 'ODP 16')->count();
            $rumusOdp8 = $countOdp8 * 8;
            $rumusOdp16 = $countOdp16 * 16;
            $real_golive = null;
            if ($form->status_gl_sdi == 'GOLIVE') {
                $real_golive = date('Y-m-d');
            } else {
                $real_golive = null;
            }
            TranSupervisi::where("id", $form->id)
                ->update([
                    'odp_8' => $countOdp8,
                    'odp_16' => $countOdp16,
                    'odp_port' => $rumusOdp8 + $rumusOdp16,
                    'real_port' => $rumusOdp8 + $rumusOdp16,
                    'real_golive' => $real_golive,
                ]);
            admin_success('Inventory ' . $form->status_gl_sdi . ' Updated');
            admin_toastr('Inventory ' . $form->status_gl_sdi . ' Updated', 'success');
            return redirect('/ped-panel/tran-inventory/' . $form->id . '/edit');
        });

        $form->confirm('Anda akan melakukan update inventory ini ?', 'edit');

        return $form;
    }

    public function generateOdp(Request $request)
    {
        // print_r($_POST);
        // echo $request->supervisi_id;
        // die();
        $kode_odp_in = $request->input('kode_odp_in'); // Mengambil nilai input sebagai array

        foreach ($kode_odp_in as $cek => $kode_odp) {
            $odp = TranOdp::create([
                'supervisi_id' => $request->supervisi_id,
                'jenis_odp' => $_POST['jenis_odp_in'][$cek],
                'nama_odp' => $_POST['kode_odp_in'][$cek],
            ]);
            $odp->save();
        }

        $countOdp8 = TranOdp::where("supervisi_id", $request->supervisi_id)->where('jenis_odp', '=', 'ODP 8')->count();
        $countOdp16 = TranOdp::where("supervisi_id", $request->supervisi_id)->where('jenis_odp', '=', 'ODP 16')->count();
        $rumusOdp8 = $countOdp8 * 8;
        $rumusOdp16 = $countOdp16 * 16;
        TranSupervisi::where("id", $request->supervisi_id)
            ->update([
                'odp_8' => $countOdp8,
                'odp_16' => $countOdp16,
                'odp_port' => $rumusOdp8 + $rumusOdp16,
                'real_port' => $rumusOdp8 + $rumusOdp16,
            ]);

        admin_success('ODP Updated');
        admin_toastr('ODP Project Updated', 'success');
        //return back();
        return redirect('/ped-panel/tran-inventory/' . $request->supervisi_id);
    }

    public function updateOdp(Request $request)
    {
        //print_r($_POST);
        $status_go_live = $request->input('status_go_live'); // Mengambil nilai input sebagai array
        foreach ($status_go_live as $i => $status_odp) {
            TranOdp::where("id", $_POST['odp_id'][$i])
                ->update([
                    'status_go_live' => $_POST['status_go_live'][$i],
                    'kendala' => $_POST['kendala'][$i],
                    'status_abd' => $_POST['status_abd'][$i],
                    'real_golive' => $_POST['real_golive'][$i],
                ]);

        }
        admin_success('ODP Updated');
        admin_toastr('ODP Updated', 'success');
        //return back();
        return redirect('/ped-panel/tran-inventory/' . $request->supervisi_id);
    }

    public function updateInventory(Request $request)
    {
        $real_golive = null;
        if ($request->status_gl_sdi == 'GOLIVE') {
            $real_golive = date('Y-m-d');
        }
        TranSupervisi::where("id", $request->supervisi_id)
            ->update([
                'status_gl_sdi' => $request->status_gl_sdi,
                'ket_gl_sdi' => $request->ket_gl_sdi,
                'status_abd' => $request->status_abd,
                'id_sw' => $request->id_sw,
                'id_imon' => $request->id_imon,
                'real_golive' => $real_golive,
            ]);

        admin_success('Inventory Updated');
        admin_toastr('Inventory Project Updated', 'success');
        //return back();
        return redirect('/ped-panel/tran-inventory/' . $request->supervisi_id);
    }
}
