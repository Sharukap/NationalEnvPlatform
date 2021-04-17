<?php


use SystemData\Http\Controllers\SystemDataController;

//Route::get('/test', [SystemDataController::class, 'test']); // 'system-data/test' will return to this.

//use system-data as the prefix for any routes in SystemData module


// Route::get('/accesscreate', [SystemDataController::class, 'accesscreate']); // 'system-data/test' will return to this.
// Route::post('/accesssave', [SystemDataController::class, 'accesssave']);
Route::get('/accessedit/{id}', [SystemDataController::class, 'accessedit']);
Route::patch('/accessupdate/{id}', [SystemDataController::class, 'accessupdate']);
// Route::delete('/accessdelete/{id}', [SystemDataController::class, 'accessdelete']);
Route::get('/accessindex', [SystemDataController::class, 'accessindex'])->name('accessindex');

Route::get('/activityindex', [SystemDataController::class, 'activityindex'])->name('activityindex');
Route::get('/activitycreate', [SystemDataController::class, 'activitycreate']);
Route::post('/activitysave', [SystemDataController::class, 'activitysave']);
Route::get('/activityedit/{id}', [SystemDataController::class, 'activityedit']);
Route::patch('/activityupdate/{id}', [SystemDataController::class, 'activityupdate']);
Route::delete('/activitydelete/{id}', [SystemDataController::class, 'activitydelete']);



Route::get('/crimetypescreate', [SystemDataController::class, 'crimetypescreate']);
Route::post('/crimetypessave', [SystemDataController::class, 'crimetypessave']);
Route::get('/crimetypesedit/{id}', [SystemDataController::class, 'crime_typesedit']);
Route::patch('/crime_typesupdate/{id}', [SystemDataController::class, 'crime_typesupdate']);
Route::delete('/crimetypesdelete/{id}', [SystemDataController::class, 'crime_typesdelete']);
Route::get('/crimetypeindex', [SystemDataController::class, 'crimetypeindex'])->name('crimetypeindex');



Route::get('/eco_typescreate', [SystemDataController::class, 'eco_typescreate']);
Route::post('/eco_typessave', [SystemDataController::class, 'eco_typessave']);
Route::get('/eco_typesedit/{id}', [SystemDataController::class, 'eco_typesedit']);
Route::patch('/eco_typesupdate/{id}', [SystemDataController::class, 'eco_typesupdate']);
Route::get('/eco_typesindex', [SystemDataController::class, 'eco_typesindex'])->name('ecotypeindex');
Route::delete('/eco_typesdelete/{id}', [SystemDataController::class, 'eco_typesdelete']);


Route::get('/org_typescreate', [SystemDataController::class, 'org_typescreate']);
Route::post('/org_typessave', [SystemDataController::class, 'org_typessave']);
Route::get('/org_typesedit/{id}', [SystemDataController::class, 'org_typesedit']);
Route::patch('/org_typesupdate/{id}', [SystemDataController::class, 'org_typesupdate']);
Route::get('/org_typesindex', [SystemDataController::class, 'org_typesindex'])->name('orgtypeindex');
Route::delete('/org_typedelete/{id}', [SystemDataController::class, 'org_typesdelete']);



Route::get('/gazettescreate', [SystemDataController::class, 'gazettescreate']);
Route::post('/gazettessave', [SystemDataController::class, 'gazettessave']);
Route::get('/gazzettesedit/{id}', [SystemDataController::class, 'gazzettesedit']);
Route::patch('/gazzettesupdate/{id}', [SystemDataController::class, 'gazzettesupdate']);
Route::get('/gazzettesview/{id}', [SystemDataController::class, 'gazzettesview']);
Route::delete('/gazzettesdelete/{id}', [SystemDataController::class, 'gazzettesdelete']);
Route::get('/gazetteindex', [SystemDataController::class, 'gazettesindex'])->name('gazetteindex');
