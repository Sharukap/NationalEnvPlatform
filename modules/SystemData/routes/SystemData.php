<?php


use SystemData\Http\Controllers\SystemDataController;




Route::get('/test', [SystemDataController::class, 'test']); // 'system-data/test' will return to this.

//use system-data as the prefix for any routes in SystemData module

