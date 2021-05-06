<?php

use ApprovalItem\Http\Controllers\ApprovalItemController;
Route::get('/showRequests', [ApprovalItemController::class, 'showRequests'])->middleware(['auth']);
Route::get('/filterRequests', [ApprovalItemController::class, 'filterRequests']);
Route::middleware(['access.control:6'])->group(function () {
    
    Route::get('/assignorganization/{id}/{nid}', [ApprovalItemController::class, 'choose_assign_organization'])->middleware(['notifiy.read','restrict.own']);

    Route::get('/assignorganization/{id}', [ApprovalItemController::class, 'choose_assign_organization'])->middleware(['restrict.own']);

    Route::get('/changeassignOrganization/{oid}/{id}', [ApprovalItemController::class, 'change_assign_organization'])->middleware(['restrict.own']);

    Route::post('/changeassignOrganization', [ApprovalItemController::class, 'assign_unregistered_organization']);
});
Route::middleware(['access.control:7'])->group(function () {
    Route::get('/assignstaff/{id}', [ApprovalItemController::class, 'choose_assign_staff'])->middleware(['restrict.own']);

    Route::get('/assignstaff/{id}/{nid}', [ApprovalItemController::class, 'choose_assign_staff'])->middleware(['notifiy.read','restrict.own']);

    Route::get('/confirmassign/{uid}/{id}', [ApprovalItemController::class, 'confirm_assign_staff'])->middleware(['restrict.own']);
});

Route::middleware(['access.control:8'])->group(function () {
    Route::get('/cancelprerequisite/{id}/{uid}', [ApprovalItemController::class, 'cancel_prerequisite']);
    
    Route::get('/investigate/{id}/{nid}', [ApprovalItemController::class, 'investigate'])->middleware(['notifiy.read','restrict.own']);

    Route::get('/investigate/{id}', [ApprovalItemController::class, 'investigate'])->middleware(['restrict.own']);

    Route::post('/createprerequisite', [ApprovalItemController::class, 'create_prerequisite']);

    Route::post('/finalapproval', [ApprovalItemController::class, 'final_approval']);

    Route::post('/progresssave', [ApprovalItemController::class, 'progress_update']);
});







