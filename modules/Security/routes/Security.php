<?php


use Security\Http\Controllers\SecurityController;



Route::get('/main/{id}', [SecurityController::class, 'auditdisplay']); 

Route::get('/individual/{id}/{pid}', [SecurityController::class, 'moredetails']); 