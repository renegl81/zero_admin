<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\App\HomeController as AppHomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Zero\Services\MenuService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::get('/', [AppHomeController::class, 'index'])->name('app.home');


Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => Config::get('zero.route_prefix')], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/edit', [ProfileController::class, 'edit'])->name('profile_edit');
    Route::resource('users', UserController::class);

    Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => 'zero'], function () {
        Route::get('/menu-items', [MenuService::class, 'getMenuItems'])->name('menu_items');
    });
});



