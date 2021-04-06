<?php


use UserIntruction\Http\Controllers\UserIntructionController;



Route::get('/test', [UserIntructionController::class, 'test']); // 'help/test'  will route to this. always use 'help' as the prefix for any routes in UserInstruction module