<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\server\ServerController;

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
Route::prefix('core')->group(function () {
    Route::prefix('system')->group(function () {
        Route::prefix('check')->group(function () {
            Route::group(['middleware' => 'server.not.login'], function() {
                Route::get('/login', [ServerController::class, 'login'])->name('dev.login');
                Route::post('/login', [ServerController::class, 'checkLogin'])->name('dev.checklogin');
            });
            Route::group(['middleware' => 'server.is.login'], function() {
                Route::get('/', [ServerController::class, 'index'])->name('devsystem.dashboard');
                Route::get('/logout', [ServerController::class, 'logout'])->name('dev.logout');
                Route::get('/system-info', [ServerController::class, 'systemInfo'])->name('system.info');
                Route::get('/php-info', [ServerController::class, 'phpInfo'])->name('php.info');
                Route::get('/active-extensions', [ServerController::class, 'activeExtensions'])->name('active.extensions');
                Route::get('/server-info', [ServerController::class, 'serverInfo'])->name('server.info');
                Route::get('/other-info', [ServerController::class, 'laravelInfo'])->name('laravel.info');
            });
        });
    });
});