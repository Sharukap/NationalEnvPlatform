<?php

use Reporting\Http\Controllers\ReportingController;

Route::get('/overview', [ReportingController::class, 'overview'])->name("reportingOverview"); 
Route::get('/get-processItem-chart-data',[ReportingController::class, 'getMonthlyProcessItemData']);
Route::get('/get-processItem-formType-chart-data',[ReportingController::class, 'getProcessItemFormTypeData']);
Route::get('/get-processItem-assignedOrganization-chart-data',[ReportingController::class, 'getProcessItemOrganizationData']);
Route::get('/filterOverview',[ReportingController::class, 'filterOverview']);
Route::post('/overview-report',[ReportingController::class, 'overviewReport']);

Route::get('/tree-removal', [ReportingController::class, 'treeRemoval'])->name("reportingTreeRemoval"); 
Route::get('/get-treeRemoval-chart-data',[ReportingController::class, 'getMonthlyTreeRemovalData']);
Route::get('/get-treeRemoval-province-chart-data',[ReportingController::class, 'getTreeRemovalProvinceData']);
Route::get('/get-treeRemoval-district-chart-data',[ReportingController::class, 'getTreeRemovalDistrictData']);
Route::get('/tree-removal-report/{id}', [ReportingController::class, 'treeRemovalRequest']); 

Route::get('/restoration', [ReportingController::class, 'restoration'])->name("reportingRestoration"); 
Route::get('/get-restoration-chart-data',[ReportingController::class, 'getMonthlyRestorationData']);
Route::get('/get-restoration-type-chart-data',[ReportingController::class, 'getRestorationActivityTypeData']);
Route::get('/get-restoration-ecosystem-chart-data',[ReportingController::class, 'getRestorationEcosystemData']);
Route::get('/env-restoration-report/{id}', [ReportingController::class, 'restorationRequest']); 

Route::get('/dev-proj', [ReportingController::class, 'devProject'])->name("reportingDevProj"); 
Route::get('/get-developmentProject-chart-data',[ReportingController::class, 'getMonthlyDevelopmentProjectData']);
Route::get('/get-developmentProject-organization-chart-data',[ReportingController::class, 'getDevelopmentProjectOrganizationData']);
Route::get('/dev-project-report/{id}', [ReportingController::class, 'developmentProjectRequest']); 

Route::get('/complaints', [ReportingController::class, 'crimeReport'])->name("reportingComplaints"); 
Route::get('/get-crimeReport-chart-data',[ReportingController::class, 'getMonthlyCrimeReportData']);
Route::get('/get-crimeReport-type-chart-data',[ReportingController::class, 'getCrimeReportTypeData']);
Route::get('/get-crimeReport-actionTaken-chart-data',[ReportingController::class, 'getCrimeReportActionTakenData']); 
Route::get('/crime-details-report/{id}', [ReportingController::class, 'crimeReportRequest']); 
