<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Project\SupervisiController;

Route::controller(SupervisiController::class)
            ->prefix('supervisi')
            ->group(function () {
                Route::get('/index', 'index')->name('supervisi.index'); 
                Route::get('/json', 'jsonProject')->name('supervisi.json');
                Route::get('/detail/{id}/{slug}', 'detail')->name('supervisi.detail');     

                /** Plan Activity */
                Route::get('/plan-activity/{id}/{slug}', 'planActivity')->name('supervisi.plan');
                Route::post('/plan-activity/add-date', 'planActivityAddDate')->name('supervisi.plan.adddate');
                Route::post('/plan-activity/submit-plan', 'planActivitySubmit')->name('supervisi.plan.submit');

                 /** Actual Activity */
                 Route::get('/actual-activity/{id}/{slug}', 'actualActivity')->name('supervisi.actual');
                 Route::post('/actual-activity/add-date', 'planActivityAddDate')->name('supervisi.plan.adddate');
                 Route::post('/actual-activity/submit-plan', 'planActivitySubmit')->name('supervisi.plan.submit');
               
            });