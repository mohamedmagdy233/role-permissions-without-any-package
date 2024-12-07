<?php

use App\Http\Controllers\Api\AuthControlller;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// start auth routes


    Route::group(['prefix' => 'auth'], function () {
        Route::post('signup', [AuthControlller::class, 'signup']);
        Route::post('signin', [AuthControlller::class, 'signIn']);
        Route::post('restPassword', [AuthControlller::class, 'restPassword']);
        Route::post('loginWithGoogle', [AuthControlller::class, 'loginWithGoogle']);
        Route::post('deleteMyAccount', [AuthControlller::class, 'deleteMyAccount']);
        Route::post('logout', [AuthControlller::class, 'logout']);

    });

    #=======================================================================
    #============================ USER =====================================
    #=======================================================================

    Route::group(['middleware' => 'jwt'], function () {
        Route::get('getCategories', [UserController::class, 'getCategories']); // we can make this out jwt
    });
