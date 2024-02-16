<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicineAlertController;
use App\Http\Controllers\BasicMedicalInfoController;
use App\Models\Patient;

Route::get('/patient-route', function () {
    return 'This is a patient route!';
    
});
Route::get('/patients',[PatientController::class,'index'])->name('patients');
Route::get('/patients/{id}',[PatientController::class,'show'])
->name('show');
Route::post('/patients',[PatientController::class,'store'])->name('store');
Route::put('/patients/{id}/update',[PatientController::class,'update'])->name('update');
Route::delete('/patients/{id}/delete',[PatientController::class,'destroy'])->name('destroy');

///////////////////////
Route::get('/medical-info', [BasicMedicalInfoController::class, 'index']);
Route::get('/medical-info/{patientId}', [BasicMedicalInfoController::class, 'show']);
Route::post('/medical-info', [BasicMedicalInfoController::class, 'store']);
Route::put('/medical-info/{id}/update', [BasicMedicalInfoController::class, 'update']);
Route::delete('/medical-info/{id}/delete', [BasicMedicalInfoController::class, 'destroy']);