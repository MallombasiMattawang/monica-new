<?php

use App\Admin\Actions\Project\Approval;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    /** Route Verifikator */
    $router->resource('users', UserController::class);

    /**Route tabel master */
    $router->resource('mst-witels', MstWitelController::class);
    $router->resource('mst-mitras', MstMitraController::class);
    $router->resource('mst-projects', MstProjectController::class);
    $router->resource('mst-saps', MstSapController::class);
    $router->resource('mst-smilleys', MstSmilleyController::class);

    /**Route tabel referensi */
    $router->resource('ref-list-activities', RefListActivityController::class);
    $router->resource('ref-bobots', RefBobotController::class);

    /**tabel transaksi */
    $router->resource('tran-supervisis', TranSupervisiController::class);
    $router->resource('tran-inventory', TranInventoryController::class);
    $router->resource('tran-administrasi', TranAdministrasiController::class);

    /**Tabel Template excel */
    $router->resource('template-excels', TemplateExcelController::class);

    /**Import File Project */
    $router->get('form-import-project', 'MstProjectController@formImport');
    $router->post('submit-import-project', 'MstProjectController@submitImport');

    /**Submit start-finish dan status project */
    $router->post('submit-play-project', 'MstProjectController@submitPlayProject');

    /**drop project */
    $router->post('submit-drop-project', 'MstProjectController@submitDropProject');

    /**Import File SAP */
    $router->get('form-import-sap', 'MstSapController@formImport');
    $router->post('submit-import-sap', 'MstSapController@submitImport');

    /**Import File Smilley */
    $router->get('form-import-smilley', 'MstSmilleyController@formImport');
    $router->post('submit-import-smilley', 'MstSmilleyController@submitImport');

    /**Supervisi */
    $router->get('add-waspang', 'TranSupervisiController@addWaspang');
    $router->get('add-ut', 'TranSupervisiController@addUt');

    /**Create & update Baseline */
    $router->get('form-baseline/{id}', 'TranSupervisiController@formBaseline');
    $router->post('create-baseline', 'TranSupervisiController@createBaseline');
    $router->post('update-baseline', 'TranSupervisiController@updateBaseline');


    $router->post('plan-baseline', 'TranSupervisiController@baseLineActivityPlan');
    $router->post('acc-project', 'TranSupervisiController@accProcject');
    $router->post('plan-project', 'TranSupervisiController@submitPlan');
    $router->post('assign-project', 'TranSupervisiController@assignPlan');

    /**Approval administrasi witel */
    $router->post('approve-administrasi-witel', 'TranAdministrasiController@approveWitel');
    $router->post('reject-administrasi-witel', 'TranAdministrasiController@rejectWitel');
    $router->post('ttd-administrasi-witel', 'TranAdministrasiController@ttdWitel');

     /**Approval administrasi telkom regional */
     $router->post('approve-administrasi-regional', 'TranAdministrasiController@approveRegional');
     $router->post('reject-administrasi-regional', 'TranAdministrasiController@rejectRegional');
     $router->post('ttd-administrasi-regional', 'TranAdministrasiController@ttdRegional');

     /**Approval BA Rekon telkom regional */
     $router->post('approve-administrasi-ba', 'TranAdministrasiController@approveBa');
     $router->post('reject-administrasi-ba', 'TranAdministrasiController@rejectBa');
});
