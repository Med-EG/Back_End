<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\AllergiesController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorAssistantController;
use App\Http\Controllers\BasicMedicalInfoController;
use App\Http\Controllers\WorkingDayController;
use App\Http\Controllers\DoctorContactNumberController;

Route::get('/doctor-route', function () {
    return 'This is a doctor route!';
});

//Medicine routes
Route::get('/med', [MedicationController::class,'index'] );
Route::get('/med/{id}', [MedicationController::class,'show'] );
Route::post('/med', [MedicationController::class,'store'] );
Route::put('/med/{id}', [MedicationController::class,'update'] );
Route::delete('/med/{id}', [MedicationController::class,'destroy'] );

//Disease routes
Route::get('/dis', [DiseaseController::class,'index'] );
Route::get('/dis/{id}', [DiseaseController::class,'show'] );
Route::post('/dis', [DiseaseController::class,'store'] );
Route::put('/dis/{id}', [DiseaseController::class,'update'] );
Route::delete('/dis/{id}', [DiseaseController::class,'destroy'] );

//Allergy routes
Route::get('/alg', [AllergiesController::class,'index'] );
Route::get('/alg/{id}', [AllergiesController::class,'show'] );
Route::post('/alg', [AllergiesController::class,'store'] );
Route::put('/alg/{id}', [AllergiesController::class,'update'] );
Route::delete('/alg/{id}', [AllergiesController::class,'destroy'] );

//Operation routes
Route::get('/op', [OperationController::class,'index'] );
Route::get('/op/{id}', [OperationController::class,'show'] );
Route::post('/op', [OperationController::class,'store'] );
Route::put('/op/{id}', [OperationController::class,'update'] );
Route::delete('/op/{id}', [OperationController::class,'destroy'] );

//Doctor routes
Route::get('/doctor', [DoctorController::class,'index'] );
Route::get('/doctor/{id}', [DoctorController::class,'show'] );
Route::post('/doctor', [DoctorController::class,'store'] );
Route::put('/doctor/{id}', [DoctorController::class,'update'] );
Route::delete('/doctor/{id}', [DoctorController::class,'destroy'] );

//Doctor Assistant routes
Route::get('/ast', [DoctorAssistantController::class,'index'] );
Route::get('/ast/doc/{id}', [DoctorAssistantController::class,'one_doc'] );
Route::get('/ast/{id}', [DoctorAssistantController::class,'show'] );
Route::post('/ast', [DoctorAssistantController::class,'store'] );
Route::put('/ast/{id}', [DoctorAssistantController::class,'update'] );
Route::delete('/ast/{id}', [DoctorAssistantController::class,'destroy'] );

//Medical Record routes
Route::get('/rec', [BasicMedicalInfoController::class,'index'] );
Route::get('/rec/{id}', [BasicMedicalInfoController::class,'show'] );
Route::post('/rec', [BasicMedicalInfoController::class,'store'] );
Route::put('/rec/{id}', [BasicMedicalInfoController::class,'update'] );
Route::delete('/rec/{id}', [BasicMedicalInfoController::class,'destroy'] );

//Doctor working days routes
Route::get('/day', [WorkingDayController::class,'index'] );
Route::get('/day/doc/{id}', [WorkingDayController::class,'one_doc'] );
Route::get('/day/{id}', [WorkingDayController::class,'show'] );
Route::post('/day', [WorkingDayController::class,'store'] );
Route::put('/day/{id}', [WorkingDayController::class,'update'] );
Route::delete('/day/{id}', [WorkingDayController::class,'destroy'] );

//Doctor contact numbers routes
Route::get('/num', [DoctorContactNumberController::class,'index'] );
Route::get('/num/doc/{id}', [DoctorContactNumberController::class,'showByDoctor'] );
Route::get('/num/{id}', [DoctorContactNumberController::class,'showById'] );
Route::post('/num', [DoctorContactNumberController::class,'store'] );
Route::put('/num/{id}', [DoctorContactNumberController::class,'update'] );
Route::delete('/num/{id}', [DoctorContactNumberController::class,'destroy'] );
