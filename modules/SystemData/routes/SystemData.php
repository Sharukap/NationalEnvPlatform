<?php


use SystemData\Http\Controllers\SystemDataController;




Route::get('/test', [SystemDataController::class, 'test']); // 'sytem-data/test' will return to this.

//use sytem-data as the prefix for any routes in SystemData module

