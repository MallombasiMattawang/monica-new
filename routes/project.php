<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Project\ProjectController;

Route::controller(ProjectController::class)
            ->prefix('project')
            ->group(function () {
                Route::get('/index', 'index')->name('project.index'); 
                Route::get('/json', 'jsonProject')->name('project.json');
                Route::get('/detail/{id}/{slug}', 'detail')->name('project.detail');     
            });