<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('guest')->group(function () {

   

});
Route::get('/', [DashboardController::class, 'welcome'])->name('welcome');
Route::get('/info', [DashboardController::class, 'info'])->name('info');

Route::middleware('auth:web,satker,mitra')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
   
    /**
     * user routing
     */
    Route::get('/user/profile/', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/detail/{role}/{userId}', [UserController::class, 'index'])->name('user.detail');
    Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::post('/user/change-password', [UserController::class, 'validatePassword'])->name('user.update_password');


});


require __DIR__.'/auth.php';
require __DIR__.'/paket.php';