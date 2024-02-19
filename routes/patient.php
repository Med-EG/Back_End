<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicineAlertController;
use App\Http\Controllers\BasicMedicalInfoController;
use App\Http\Controllers\PatientFaceIDController;
use App\Http\Controllers\PatientEmergencyContactsController;

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

//////////////////////////////////////
Route::get('/medical-info', [BasicMedicalInfoController::class, 'index']);
Route::get('/medical-info/{patientId}', [BasicMedicalInfoController::class, 'show']);
Route::post('/medical-info', [BasicMedicalInfoController::class, 'store']);
Route::put('/medical-info/{id}/update', [BasicMedicalInfoController::class, 'update']);
Route::delete('/medical-info/{id}/delete', [BasicMedicalInfoController::class, 'destroy']);
////////////////////////////////////////
Route::get('/medicine-alert', [MedicineAlertController::class, 'index']);
Route::get('/medicine-alert/{alert_id}', [MedicineAlertController::class, 'show']);
Route::post('/medicine-alert', [MedicineAlertController::class, 'store']);
Route::get('/medicine-alert/patient/{patientId}', [MedicineAlertController::class, 'getAllAlertsForPatient']);
Route::put('/medicine-alert/{id}/update', [MedicineAlertController::class, 'update']);
Route::delete('/medicine-alert/{id}/delete', [MedicineAlertController::class, 'destroy']);
/////////////////////////
Route::get('/patient-emergency-contacts', [PatientEmergencyContactsController::class, 'index']);
Route::get('/patient-emergency-contacts/{contact_id}', [PatientEmergencyContactsController::class, 'show']);
Route::post('/patient-emergency-contacts', [PatientEmergencyContactsController::class, 'store']);
Route::put('/patient-emergency-contacts/{contact_id}', [PatientEmergencyContactsController::class, 'update']);
Route::delete('/patient-emergency-contacts/{contact_id}', [PatientEmergencyContactsController::class, 'destroy']);
Route::get('/patients/{patientId}/emergency-contacts', [PatientEmergencyContactsController::class, 'getEmergencyContacts']);

