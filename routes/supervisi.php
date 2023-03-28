<?php

use App\Http\Controllers\Project\ActualController;
use App\Http\Controllers\Project\AdministrasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Project\SupervisiController;
use App\Http\Controllers\Project\PlanController;

Route::controller(SupervisiController::class)
    ->prefix('supervisi')
    ->group(function () {
        Route::get('/index', 'index')->name('supervisi.index');
        Route::get('/json', 'jsonProject')->name('supervisi.json');
        Route::get('/detail/{id}/{slug}', 'detail')->name('supervisi.detail');
    });
Route::controller(PlanController::class)
    ->prefix('supervisi')
    ->group(function () {
        /** Plan Activity */
        Route::get('/plan-activity/{id}/{slug}', 'planActivity')->name('supervisi.plan');
        Route::post('/plan-activity/add-date', 'planActivityAddDate')->name('supervisi.plan.adddate');
        Route::post('/plan-activity/submit-plan', 'planActivitySubmit')->name('supervisi.plan.submit');
    });

Route::controller(ActualController::class)
    ->prefix('supervisi')
    ->group(function () {
        /** Actual Activity */
        Route::get('/actual-activity/{id}/{slug}', 'actualActivity')->name('supervisi.actual');
        Route::get('/actual-activity/form-actual/{id}/{slug}', 'actualActivityForm')->name('supervisi.actual.form');
        Route::post('/actual-activity/add-actual', 'actualActivityAddDate')->name('supervisi.actual.adddate');
        Route::post('/actual-activity/approve-waspang', 'actualActivityWaspang')->name('supervisi.actual.waspang');
        Route::post('/actual-activity/approve-ut', 'actualActivityUt')->name('supervisi.actual.ut');
        Route::get('/actual-activity/log-actual/{id}/{slug}', 'actualActivityLog')->name('supervisi.actual.log');
    });

Route::controller(AdministrasiController::class)
    ->prefix('supervisi')
    ->group(function () {
        /** Administrasi Activity */
        Route::get('/administrasi-activity/{id}/{slug}', 'administrasiActivity')->name('supervisi.administrasi');
        Route::get('/administrasi-activity/form-administrasi/{id}/{cat}', 'administrasiActivityForm')->name('supervisi.administrasi.form');
        Route::post('/administrasi-docToWitel', 'docToWitel')->name('supervisi.docToWitel');
        Route::post('/administrasi-docToRegional', 'docToRegional')->name('supervisi.docToRegional');
        Route::post('/administrasi-verifikasi-internal', 'verifikasiInternal')->name('supervisi.verifikasiInternal');
        Route::post('/administrasi-ba-rekon', 'docBaRekon')->name('supervisi.docBaRekon');
    });
