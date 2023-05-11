<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

/**
 * Authentication
 */
Route::group(['controller'=>AdminAuthController::class],function(){
    Route::get('/login','login')->name('admin.login');
    Route::post('/check','check')->name('admin.check');
    Route::get('/logout', 'logout')->name('admin.logout');
});

/**
 * All Route of dashboard
 */
Route::group(['controller'=>AdminController::class,'middleware'=>'auth.admin'],function(){
    Route::get('/','index')->name('admin');
});
