<?php

use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Front\FrontController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
*/

/*** Multi Languages ***/
Route::get('local/{lang}',[LocalizationController::class,'setLang'])->name('local');
/*** Multi Languages ***/

Route::get('/',[FrontController::class,'index']);
