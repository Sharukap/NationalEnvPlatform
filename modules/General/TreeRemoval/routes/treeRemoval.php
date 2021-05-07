<?php

use TreeRemoval\Http\Controllers\TreeRemovalController;

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [TreeRemovalController::class, 'home'])->name('treeremoval.home');

    Route::get('/form', [TreeRemovalController::class, 'openForm'])->name("treeremoval");

    Route::post('/save', [TreeRemovalController::class, 'save']);

    Route::get('/show/{id}', [TreeRemovalController::class, 'show']);

    Route::delete('/delete/{processid}/{treeid}/{landid}', [TreeRemovalController::class, 'destroy']);

    //Route to get the FAQ View
    Route::get('/userinstruct', fn () => view('treeRemoval::faq'));

    Route::get('/autocompleteProvince', [TreeRemovalController::class, 'provinceAutocomplete'])->name('province');
    Route::get('/autocompleteDistrict', [TreeRemovalController::class, 'districtAutocomplete'])->name('district');
    Route::get('/autocompleteOrgs', [TreeRemovalController::class, 'organizationAutocomplete'])->name('organization');
    Route::get('/autocompleteGSdiv', [TreeRemovalController::class, 'GSAutocomplete'])->name('gramasevaka');
    Route::get('/autocompleteSpecies', [TreeRemovalController::class, 'SpeciesAutocomplete'])->name('species');
});
