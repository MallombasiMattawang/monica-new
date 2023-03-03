<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Paket\SatkerController;


Route::controller(SatkerController::class)
            ->prefix('paket-satker')
            ->group(function () {
                Route::get('/index', 'index')->name('paket.satker.index');              
                Route::post('/index', 'store')->name('paket.satker.store');
                Route::get('/json', 'jsonPaket')->name('paket.satker.json');
                Route::get('/detail/{id}/{slug}', 'detail')->name('paket.satker.detail');
                Route::get('/edit/{id}/{slug}', 'edit')->name('paket.satker.edit');                
                Route::post('/update', 'update')->name('paket.satker.update');
                Route::post('/delete', 'destroy')->name('paket.satker.destroy');
            });