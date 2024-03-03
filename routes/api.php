<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\AllergiesController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorAssistantController;
use App\Http\Controllers\BasicMedicalInfoController;
use App\Http\Controllers\WorkingDayController;
use App\Http\Controllers\DoctorContactNumberController;
use App\Http\Controllers\DoctorAppointmentController;
use App\Http\Controllers\WorkingHourController;
use App\Http\Controllers\MedicationInfoController;
use App\Http\Controllers\DiseaseInfoController;
use App\Http\Controllers\OperationInfoController;
use App\Http\Controllers\AllergiesInfoController;
use App\Http\Controllers\DoctorAuthController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicineAlertController;
use App\Http\Controllers\PatientFaceIdController;
use App\Http\Controllers\PatientEmergencyContactsController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AlertTimeController;
use App\Http\Controllers\PatientAuthController;


// Doctor Authentication Routes
// =============================================================================================
Route::post('/doctor/signup', [DoctorAuthController::class, 'signup']);
Route::post('/doctor/login', [DoctorAuthController::class, 'login']);
Route::post('/doctor/logout', [DoctorAuthController::class, 'logout'])->middleware('auth:sanctum');



// Patient Authentication Routes
// =============================================================================================
Route::post('/patient/signup', [PatientAuthController::class, 'signup']);
Route::post('/patient/login', [PatientAuthController::class, 'login']);
Route::post('/patient/logout', [PatientAuthController::class, 'logout'])->middleware('auth:sanctum');



// Secure Routes
// =============================================================================================
Route::middleware('auth:sanctum')->group(function () {

    //Medicine routes
    // =============================================================================================
    Route::get('/med', [MedicationController::class, 'index']);
    Route::get('/med/{id}', [MedicationController::class, 'show']);
    Route::post('/med', [MedicationController::class, 'store']);
    Route::put('/med/{id}', [MedicationController::class, 'update']);
    Route::delete('/med/{id}', [MedicationController::class, 'destroy']);

    //Disease routes
    // =============================================================================================
    Route::get('/dis', [DiseaseController::class, 'index']);
    Route::get('/dis/{id}', [DiseaseController::class, 'show']);
    Route::post('/dis', [DiseaseController::class, 'store']);
    Route::put('/dis/{id}', [DiseaseController::class, 'update']);
    Route::delete('/dis/{id}', [DiseaseController::class, 'destroy']);

    //Allergy routes
    // =============================================================================================
    Route::get('/alg', [AllergiesController::class, 'index']);
    Route::get('/alg/{id}', [AllergiesController::class, 'show']);
    Route::post('/alg', [AllergiesController::class, 'store']);
    Route::put('/alg/{id}', [AllergiesController::class, 'update']);
    Route::delete('/alg/{id}', [AllergiesController::class, 'destroy']);

    //Operation routes
    // =============================================================================================
    Route::get('/op', [OperationController::class, 'index']);
    Route::get('/op/{id}', [OperationController::class, 'show']);
    Route::post('/op', [OperationController::class, 'store']);
    Route::put('/op/{id}', [OperationController::class, 'update']);
    Route::delete('/op/{id}', [OperationController::class, 'destroy']);

    //Doctor routes
    // =============================================================================================
    Route::get('/doctor', [DoctorController::class, 'index']);
    Route::get('/doctor/{id}', [DoctorController::class, 'show']);
    Route::put('/doctor/{id}', [DoctorController::class, 'update']);
    Route::delete('/doctor/{id}', [DoctorController::class, 'destroy']);

    //Doctor Assistant routes
    // =============================================================================================
    Route::get('/ast', [DoctorAssistantController::class, 'index']);
    Route::get('/ast/doc/{id}', [DoctorAssistantController::class, 'one_doc']);
    Route::get('/ast/{id}', [DoctorAssistantController::class, 'show']);
    Route::post('/ast', [DoctorAssistantController::class, 'store']);
    Route::put('/ast/{id}', [DoctorAssistantController::class, 'update']);
    Route::delete('/ast/{id}', [DoctorAssistantController::class, 'destroy']);

    //Medical Record routes
    // =============================================================================================
    Route::get('/rec', [BasicMedicalInfoController::class, 'index']);
    Route::get('/rec/{id}', [BasicMedicalInfoController::class, 'show']);
    Route::post('/rec', [BasicMedicalInfoController::class, 'store']);
    Route::put('/rec/{id}', [BasicMedicalInfoController::class, 'update']);
    Route::delete('/rec/{id}', [BasicMedicalInfoController::class, 'destroy']);

    //Doctor working days routes
    // =============================================================================================
    Route::get('/day', [WorkingDayController::class, 'index']);
    Route::get('/day/doc/{id}', [WorkingDayController::class, 'one_doc']);
    Route::get('/day/{id}', [WorkingDayController::class, 'show']);
    Route::post('/day', [WorkingDayController::class, 'store']);
    Route::put('/day/{id}', [WorkingDayController::class, 'update']);
    Route::delete('/day/{id}', [WorkingDayController::class, 'destroy']);

    //Doctor working hour routes
    // =============================================================================================
    Route::get('/hr', [WorkingHourController::class, 'index']);
    Route::get('/hr/day/{id}', [WorkingHourController::class, 'showByDay']);
    Route::get('/hr/doc/{id}', [WorkingHourController::class, 'showByDoctor']);
    Route::get('/hr/{id}', [WorkingHourController::class, 'show']);
    Route::post('/hr', [WorkingHourController::class, 'store']);
    Route::put('/hr/{id}', [WorkingHourController::class, 'update']);
    Route::delete('/hr/{id}', [WorkingHourController::class, 'destroy']);

    //Doctor contact numbers routes
    // =============================================================================================
    Route::get('/num', [DoctorContactNumberController::class, 'index']);
    Route::get('/num/doc/{id}', [DoctorContactNumberController::class, 'showByDoctor']);
    Route::get('/num/{id}', [DoctorContactNumberController::class, 'showById']);
    Route::post('/num', [DoctorContactNumberController::class, 'store']);
    Route::put('/num/{id}', [DoctorContactNumberController::class, 'update']);
    Route::delete('/num/{id}', [DoctorContactNumberController::class, 'destroy']);

    //Doctor contact numbers routes
    // =============================================================================================
    Route::get('/app', [DoctorAppointmentController::class, 'index']);
    Route::get('/app/doc/{id}', [DoctorAppointmentController::class, 'showByDoctor']);
    Route::get('/app/pat/{id}', [DoctorAppointmentController::class, 'showByPatient']);
    Route::get('/app/{id}', [DoctorAppointmentController::class, 'show']);
    Route::post('/app', [DoctorAppointmentController::class, 'store']);
    Route::put('/app/{id}', [DoctorAppointmentController::class, 'update']);
    Route::delete('/app/{id}', [DoctorAppointmentController::class, 'destroy']);

    //Doctor medication info routes
    // =============================================================================================
    Route::get('/medinfo', [MedicationInfoController::class, 'index']);
    Route::get('/medinfo/day/{id}', [MedicationInfoController::class, 'showByRecord']);
    Route::get('/medinfo/doc/{id}', [MedicationInfoController::class, 'showByDoctor']);
    Route::get('/medinfo/{id}', [MedicationInfoController::class, 'show']);
    Route::post('/medinfo', [MedicationInfoController::class, 'store']);
    Route::put('/medinfo/{id}', [MedicationInfoController::class, 'update']);
    Route::delete('/medinfo/{id}', [MedicationInfoController::class, 'destroy']);

    //Doctor Disease Info routes
    // =============================================================================================
    Route::get('/disinfo', [DiseaseInfoController::class, 'index']);
    Route::get('/disinfo/day/{id}', [DiseaseInfoController::class, 'showByRecord']);
    Route::get('/disinfo/doc/{id}', [DiseaseInfoController::class, 'showByDoctor']);
    Route::get('/disinfo/{id}', [DiseaseInfoController::class, 'show']);
    Route::post('/disinfo', [DiseaseInfoController::class, 'store']);
    Route::put('/disinfo/{id}', [DiseaseInfoController::class, 'update']);
    Route::delete('/disinfo/{id}', [DiseaseInfoController::class, 'destroy']);

    //Doctor Operation Info routes
    // =============================================================================================
    Route::get('/opinfo', [OperationInfoController::class, 'index']);
    Route::get('/opinfo/day/{id}', [OperationInfoController::class, 'showByRecord']);
    Route::get('/opinfo/doc/{id}', [OperationInfoController::class, 'showByDoctor']);
    Route::get('/opinfo/{id}', [OperationInfoController::class, 'show']);
    Route::post('/opinfo', [OperationInfoController::class, 'store']);
    Route::put('/opinfo/{id}', [OperationInfoController::class, 'update']);
    Route::delete('/opinfo/{id}', [OperationInfoController::class, 'destroy']);

    //Doctor Allergy Info routes
    // =============================================================================================
    Route::get('/alginfo', [AllergiesInfoController::class, 'index']);
    Route::get('/alginfo/day/{id}', [AllergiesInfoController::class, 'showByRecord']);
    Route::get('/alginfo/doc/{id}', [AllergiesInfoController::class, 'showByDoctor']);
    Route::get('/alginfo/{id}', [AllergiesInfoController::class, 'show']);
    Route::post('/alginfo', [AllergiesInfoController::class, 'store']);
    Route::put('/alginfo/{id}', [AllergiesInfoController::class, 'update']);
    Route::delete('/alginfo/{id}', [AllergiesInfoController::class, 'destroy']);

    Route::get('/patients',[PatientController::class,'index']);
Route::get('/patients/{id}',[PatientController::class,'show']);
Route::post('/patients',[PatientController::class,'store']);
Route::put('/patients/{id}/update',[PatientController::class,'update']);
Route::delete('/patients/{id}/delete',[PatientController::class,'destroy']);

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
//////////////////////////
Route::get('/chat', [ChatController::class, 'index']);
Route::get('/chat/{chatId}', [ChatController::class, 'show']);
Route::post('/chat', [ChatController::class, 'store']);
Route::delete('/chat/{chatId}/delete', [ChatController::class, 'destroy']);
/////////////////////////
Route::get('/patient-face-ids', [PatientFaceIdController::class, 'index']);
Route::get('/patient-face-ids/{id}', [PatientFaceIdController::class, 'show']);
Route::post('/patient-face-ids', [PatientFaceIdController::class, 'store']);
Route::put('/patient-face-ids/{id}', [PatientFaceIdController::class, 'update']);
Route::delete('/patient-face-ids/{id}', [PatientFaceIdController::class, 'destroy']);
Route::get('/patient-face-ids/patient/{patientId}', [PatientFaceIdController::class, 'getFaceIdsForOnePatient']);
//////////////////////////
Route::get('/alert-times', [AlertTimeController::class, 'index']);
Route::get('/alert-times/{id}', [AlertTimeController::class, 'show']);
Route::post('/alert-times', [AlertTimeController::class, 'store']);
Route::put('/alert-times/{id}', [AlertTimeController::class, 'update']);
Route::delete('/alert-times/{id}', [AlertTimeController::class, 'destroy']);

});

