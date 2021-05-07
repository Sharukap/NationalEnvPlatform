<?php

use DevelopmentProject\Http\Controllers\DevelopmentProjectController;
Route::middleware(['auth'])->group(function () {
Route::get('/home', [DevelopmentProjectController::class, 'home'])->name('developmentproject.home');

Route::get('/check', [DevelopmentProjectController::class, 'test']);

Route::get('/applicationForm', [DevelopmentProjectController::class, 'form'])->name("devproject");

Route::post('/saveForm', [DevelopmentProjectController::class, 'save']);

Route::get('/show/{id}',  [DevelopmentProjectController::class, 'show']); 

//route to delete a created request
Route::delete('/delete/{processid}/{devid}/{landid}', [DevelopmentProjectController::class, 'destroy']); 

//Route to get the FAQ View
Route::get('/userinstruct', fn() => view('developmentProject::faq'));

Route::get('/autocompleteGazette', [DevelopmentProjectController::class, 'gazetteAutocomplete'])->name('gazette');

});