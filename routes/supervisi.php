<?php

use App\Http\Controllers\Project\ActualController;
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
    });
