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
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AlertTimeController;
use App\Http\Controllers\PatientAuthController;
use App\Http\Controllers\DoctorAssistantAuthController;


// Authentication Routes
// ====================================================================================================================
// ====================================================================================================================

    // Doctor Authentication Routes
    // =============================================================================================
    Route::post('/doctor/signup', [DoctorAuthController::class, 'signup']);
    Route::post('/doctor/login', [DoctorAuthController::class, 'login']);
    Route::post('/doctor/logout', [DoctorAuthController::class, 'logout'])->middleware('auth:sanctum');


    // Doctor Assistant Authentication Routes
    // =============================================================================================
    Route::post('/doctor/assistant/signup', [DoctorAssistantAuthController::class, 'signup']);
    Route::post('/doctor/assistant/login', [DoctorAssistantAuthController::class, 'login']);
    Route::post('/doctor/assistant/logout', [DoctorAssistantAuthController::class, 'logout'])->middleware('auth:sanctum');

    // Patient Authentication Routes
    // =============================================================================================
    Route::post('/patient/signup', [PatientAuthController::class, 'signup']);
    Route::post('/patient/login', [PatientAuthController::class, 'login']);
    Route::post('/patient/logout', [PatientAuthController::class, 'logout'])->middleware('auth:sanctum');


// Public Routes
// ====================================================================================================================
// ====================================================================================================================

    //doctor specialization
    Route::get('/doctorSpecialization', [DoctorController::class, 'specialization']);




// Secure Routes
// ====================================================================================================================
// ====================================================================================================================
Route::middleware('auth:sanctum')->group(function () {


    // Doctor routes
    // =============================================================================================
    Route::get('/doctor', [DoctorController::class, 'index']);
    Route::get('/doctor/{id}', [DoctorController::class, 'show']);
    Route::put('/doctor/{id}', [DoctorController::class, 'update']);
    // Route::delete('/doctor/{id}', [DoctorController::class, 'destroy']);

    // Doctor working days routes
    // =============================================================================================
    Route::get('/day', [WorkingDayController::class, 'index']);
    Route::get('/day/doctor/{id}', [WorkingDayController::class, 'one_doc']);
    Route::get('/day/{id}', [WorkingDayController::class, 'show']);
    Route::post('/day', [WorkingDayController::class, 'store']);
    Route::put('/day/{id}', [WorkingDayController::class, 'update']);
    Route::delete('/day/{id}', [WorkingDayController::class, 'destroy']);

    // Doctor working hour routes
    // =============================================================================================
    Route::get('/hour', [WorkingHourController::class, 'index']);
    Route::get('/hour/day/{id}', [WorkingHourController::class, 'showByDay']);
    Route::get('/hour/doctor/{id}', [WorkingHourController::class, 'showByDoctor']);
    Route::get('/hour/{id}', [WorkingHourController::class, 'show']);
    Route::post('/hour', [WorkingHourController::class, 'store']);
    Route::put('/hour/{id}', [WorkingHourController::class, 'update']);
    Route::delete('/hour/{id}', [WorkingHourController::class, 'destroy']);

    // Doctor contact numbers routes
    // =============================================================================================
    Route::get('/number', [DoctorContactNumberController::class, 'index']);
    Route::get('/number/doc/{id}', [DoctorContactNumberController::class, 'showByDoctor']);
    Route::get('/number/{id}', [DoctorContactNumberController::class, 'showById']);
    Route::post('/number', [DoctorContactNumberController::class, 'store']);
    Route::put('/number/{id}', [DoctorContactNumberController::class, 'update']);
    Route::delete('/number/{id}', [DoctorContactNumberController::class, 'destroy']);

    // Doctor Appointment numbers routes
    // =============================================================================================
    Route::get('/appointment', [DoctorAppointmentController::class, 'index']);
    Route::get('/appointment/doctor/{id}', [DoctorAppointmentController::class, 'showByDoctor']);
    Route::get('/appointment/patient/{id}', [DoctorAppointmentController::class, 'showByPatient']);
    Route::get('/appointment/{id}', [DoctorAppointmentController::class, 'show']);
    Route::post('/appointment', [DoctorAppointmentController::class, 'store']);
    Route::put('/appointment/{id}', [DoctorAppointmentController::class, 'update']);
    Route::delete('/appointment/{id}', [DoctorAppointmentController::class, 'destroy']);

    // Doctor Assistant routes
    // =============================================================================================
    Route::get('/assistant', [DoctorAssistantController::class, 'index']);
    Route::get('/assistant/doctor/{id}', [DoctorAssistantController::class, 'one_doc']);
    Route::get('/assistant/{id}', [DoctorAssistantController::class, 'show']);
    Route::post('/assistant', [DoctorAssistantController::class, 'store']);
    Route::put('/assistant/{id}', [DoctorAssistantController::class, 'update']);
    Route::delete('/assistant/{id}', [DoctorAssistantController::class, 'destroy']);












    // Medical Record routes
    // =============================================================================================
    Route::get('/record', [BasicMedicalInfoController::class, 'index']);
    Route::get('/record/{id}', [BasicMedicalInfoController::class, 'show']);
    Route::post('/record', [BasicMedicalInfoController::class, 'store']);
    Route::put('/record/{id}', [BasicMedicalInfoController::class, 'update']);
    Route::delete('/record/{id}', [BasicMedicalInfoController::class, 'destroy']);

    // medication info routes
    // =============================================================================================
    Route::get('/medication-info', [MedicationInfoController::class, 'index']);
    Route::get('/medication-info/day/{id}', [MedicationInfoController::class, 'showByRecord']);
    Route::get('/medication-info/doc/{id}', [MedicationInfoController::class, 'showByDoctor']);
    Route::get('/medication-info/{id}', [MedicationInfoController::class, 'show']);
    Route::post('/medication-info', [MedicationInfoController::class, 'store']);
    Route::put('/medication-info/{id}', [MedicationInfoController::class, 'update']);
    Route::delete('/medication-info/{id}', [MedicationInfoController::class, 'destroy']);

    // Disease Info routes
    // =============================================================================================
    Route::get('/disease-info', [DiseaseInfoController::class, 'index']);
    Route::get('/disease-info/day/{id}', [DiseaseInfoController::class, 'showByRecord']);
    Route::get('/disease-info/doc/{id}', [DiseaseInfoController::class, 'showByDoctor']);
    Route::get('/disease-info/{id}', [DiseaseInfoController::class, 'show']);
    Route::post('/disease-info', [DiseaseInfoController::class, 'store']);
    Route::put('/disease-info/{id}', [DiseaseInfoController::class, 'update']);
    Route::delete('/disease-info/{id}', [DiseaseInfoController::class, 'destroy']);

    // Operation Info routes
    // =============================================================================================
    Route::get('/operation-info', [OperationInfoController::class, 'index']);
    Route::get('/operation-info/day/{id}', [OperationInfoController::class, 'showByRecord']);
    Route::get('/operation-info/doc/{id}', [OperationInfoController::class, 'showByDoctor']);
    Route::get('/operation-info/{id}', [OperationInfoController::class, 'show']);
    Route::post('/operation-info', [OperationInfoController::class, 'store']);
    Route::put('/operation-info/{id}', [OperationInfoController::class, 'update']);
    Route::delete('/operation-info/{id}', [OperationInfoController::class, 'destroy']);

    // Allergy Info routes
    // =============================================================================================
    Route::get('/allergy-info', [AllergiesInfoController::class, 'index']);
    Route::get('/allergy-info/day/{id}', [AllergiesInfoController::class, 'showByRecord']);
    Route::get('/allergy-info/doc/{id}', [AllergiesInfoController::class, 'showByDoctor']);
    Route::get('/allergy-info/{id}', [AllergiesInfoController::class, 'show']);
    Route::post('/allergy-info', [AllergiesInfoController::class, 'store']);
    Route::put('/allergy-info/{id}', [AllergiesInfoController::class, 'update']);
    Route::delete('/allergy-info/{id}', [AllergiesInfoController::class, 'destroy']);












    // Patients routes
    // =============================================================================================
    Route::get('/patients', [PatientController::class, 'index']);
    Route::get('/patients/{id}', [PatientController::class, 'show']);
    Route::put('/patients/{id}/update', [PatientController::class, 'update']);
    Route::delete('/patients/{id}/delete', [PatientController::class, 'destroy']);

    // Patient Emergency Contact routes
    // =============================================================================================
    Route::get('/emergency-contacts', [PatientEmergencyContactsController::class, 'index']);
    Route::get('/emergency-contacts/{id}', [PatientEmergencyContactsController::class, 'show']);
    Route::post('/emergency-contacts', [PatientEmergencyContactsController::class, 'store']);
    Route::put('/emergency-contacts/{id}', [PatientEmergencyContactsController::class, 'update']);
    Route::delete('/emergency-contacts/{id}', [PatientEmergencyContactsController::class, 'destroy']);
    Route::get('emergency-contacts/patient/{id}', [PatientEmergencyContactsController::class, 'getEmergencyContacts']);

    // Patient Face ID routes
    // =============================================================================================
    Route::get('/face-id', [PatientFaceIdController::class, 'index']);
    Route::get('/face-id/{id}', [PatientFaceIdController::class, 'show']);
    Route::post('/face-id', [PatientFaceIdController::class, 'store']);
    Route::put('/face-id/{id}', [PatientFaceIdController::class, 'update']);
    Route::delete('/face-id/{id}', [PatientFaceIdController::class, 'destroy']);
    Route::get('/face-id/patient/{id}', [PatientFaceIdController::class, 'getFaceIdsForOnePatient']);












    // Medicine Alert routes
    // =============================================================================================
    Route::get('/medicine-alert', [MedicineAlertController::class, 'index']);
    Route::get('/medicine-alert/{id}', [MedicineAlertController::class, 'show']);
    Route::post('/medicine-alert', [MedicineAlertController::class, 'store']);
    Route::get('/medicine-alert/patient/{id}', [MedicineAlertController::class, 'getAllAlertsForPatient']);
    Route::put('/medicine-alert/update/{id}', [MedicineAlertController::class, 'update']);
    Route::delete('/medicine-alert/delete/{id}', [MedicineAlertController::class, 'destroy']);

    // Alert Time routes
    // =============================================================================================
    Route::get('/alert-times', [AlertTimeController::class, 'index']);
    Route::get('/alert-times/{id}', [AlertTimeController::class, 'show']);
    Route::post('/alert-times', [AlertTimeController::class, 'store']);
    Route::put('/alert-times/{id}', [AlertTimeController::class, 'update']);
    Route::delete('/alert-times/{id}', [AlertTimeController::class, 'destroy']);












    // Chat routes
    // =============================================================================================
    Route::get('/chat', [ChatController::class, 'index']);
    Route::get('/chat/{id}', [ChatController::class, 'show']);
    Route::post('/chat', [ChatController::class, 'store']);
    Route::delete('/chat/delete/{id}', [ChatController::class, 'destroy']);

    // Messages routes
    // =============================================================================================
    Route::get('/message/chat/{id}', [MessageController::class, 'showMessagesInChat']);
    Route::post('/message', [MessageController::class, 'store']);
    Route::put('/message', [MessageController::class, 'update']);
    Route::delete('/message/delete/{id}', [MessageController::class, 'destroy']);












    // Static tables Routes
    // =============================================================================================
    // =============================================================================================

    // Medicine routes
    // =============================================================================================
    Route::get('/medication', [MedicationController::class, 'index']);
    Route::get('/medication/{id}', [MedicationController::class, 'show']);
    Route::post('/medication', [MedicationController::class, 'store']);
    Route::put('/medication/{id}', [MedicationController::class, 'update']);
    Route::delete('/medication/{id}', [MedicationController::class, 'destroy']);

    // Disease routes
    // =============================================================================================
    Route::get('/disease', [DiseaseController::class, 'index']);
    Route::get('/disease/{id}', [DiseaseController::class, 'show']);
    Route::post('/disease', [DiseaseController::class, 'store']);
    Route::put('/disease/{id}', [DiseaseController::class, 'update']);
    Route::delete('/disease/{id}', [DiseaseController::class, 'destroy']);

    // Allergy routes
    // =============================================================================================
    Route::get('/allergy', [AllergiesController::class, 'index']);
    Route::get('/allergy/{id}', [AllergiesController::class, 'show']);
    Route::post('/allergy', [AllergiesController::class, 'store']);
    Route::put('/allergy/{id}', [AllergiesController::class, 'update']);
    Route::delete('/allergy/{id}', [AllergiesController::class, 'destroy']);

    // Operation routes
    // =============================================================================================
    Route::get('/operation', [OperationController::class, 'index']);
    Route::get('/operation/{id}', [OperationController::class, 'show']);
    Route::post('/operation', [OperationController::class, 'store']);
    Route::put('/operation/{id}', [OperationController::class, 'update']);
    Route::delete('/operation/{id}', [OperationController::class, 'destroy']);
});