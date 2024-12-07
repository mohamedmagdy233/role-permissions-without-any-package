<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


#=======================================================================
#============================ ADMIN ====================================
#=======================================================================

Route::group(['prefix' => '1nt3rn4l-4dm1n/auth'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('admin.login');
    Route::POST('login', [AuthController::class, 'login'])->name('admin.login');
});





Route::group(['prefix' => '1nt3rn4l-4dm1n/dashboard/', 'middleware' => 'auth:admin'], function () {
    Route::get('/', function () {
        return view('admin/index');
    })->name('adminHome');





    #============================ Admin ====================================
    Route::resource('admins', AdminController::class);
    Route::POST('delete_admin', [AdminController::class, 'delete'])->name('delete_admin');
    Route::get('my_profile', [AdminController::class, 'myProfile'])->name('myProfile');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');


    #==========================roles====================================
    Route::resource('roles', RoleController::class);
    Route::POST('delete_roles', [RoleController::class, 'delete'])->name('delete_roles');




});

#=======================================================================
#============================ ROOT =====================================
#=======================================================================
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('key:generate');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    return response()->json(['status' => 'success', 'code' => 1000000000]);
});
