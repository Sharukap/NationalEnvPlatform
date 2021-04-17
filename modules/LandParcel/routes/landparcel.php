<?php

use LandParcel\Http\Controllers\LandController;

Route::get('/form', [LandController::class, 'form'])->name("land");

Route::post('/save', [LandController::class, 'save']);

Route::get('/show/{id}', [LandController::class, 'show']);



//Route to get the FAQ View
Route::get('/userinstruct', fn() => view('land::faq'));

Route::post('/ajax_upload/action', [LandController::class, 'action'])->name('ajaxmap.action');