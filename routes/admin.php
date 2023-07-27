<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\MainCategoriesController;

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
    Route::get('/login','login')->middleware('guest:admin')->name('admin.login');
    Route::post('/check','check')->name('admin.check');
    Route::get('/logout', 'logout')->name('admin.logout');
});

Route::get('test',function(){
    return getActiveLanguages();
});
/**
 * All Route of dashboard
 */
Route::group(['controller'=>AdminController::class,'middleware'=>'auth:admin'],function(){
    define('prefix','admin.');
    Route::get('/','index')->name(prefix.'home');

    /**
     * Languages
     */
    Route::group(['prefix'=>'languages','controller'=>LanguageController::class],function(){
        //GET Methods
        Route::get('/','index')->name(prefix.'language.home');
        Route::get('/create','create')->name(prefix.'language.create');
        Route::get('edit/{id}','edit')->name(prefix.'language.edit');
        Route::get('delete/{id}','delete')->name(prefix.'language.delete');
        //POST Methods
        Route::post('/store','store')->name(prefix.'language.store');
        Route::post('/update','update')->name(prefix.'language.update');
    });

    /**
     * MainCategories
     */
    Route::group(['prefix'=>'main_categories','controller'=>MainCategoriesController::class],function(){
        //GET Methods
        Route::get('/','index')->name(prefix.'main_Categories');
        Route::get('/create','create')->name(prefix.'main_Categories.create');
        Route::get('edit/{id}','edit')->name(prefix.'main_Categories.edit');
        Route::get('delete/{id}','delete')->name(prefix.'main_Categories.delete');
        Route::get('/status','status')->name(prefix.'main_Categories.status');
        //POST Methods
        Route::post('/store','store')->name(prefix.'main_Categories.store');
        Route::post('/update','update')->name(prefix.'main_Categories.update');
    });
});
