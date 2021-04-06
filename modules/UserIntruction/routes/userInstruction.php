<?php

//use UserIntruction\Http\Controllers\userInstructionController;
use UserIntruction\Http\Controllers\UserIntructionController;

use TreeRemoval\Http\Controllers\TreeRemovalController;


Route::get('/test', [UserIntructionController::class, 'test']);

