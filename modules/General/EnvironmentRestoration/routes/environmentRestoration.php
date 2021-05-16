<?php

use EnvironmentRestoration\Http\Controllers\EnvironmentRestorationController;

Route::middleware(['auth'])->group(function () {
Route::get('/show/{id}', [EnvironmentRestorationController::class, 'show']);
Route::patch('/envRestoration/update/{id}', 'Modules\General\EnvironmentRestoration\Http\Controllers\EnvironmentRestorationController@update'); 
Route::get('/create', [EnvironmentRestorationController::class, 'create'])->name("envrestoration");;
Route::post('/store', [EnvironmentRestorationController::class, 'store'])->name('store.dynamic-species'); ; 

});