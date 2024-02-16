<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\AllergiesController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\DoctorController;

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

//Operation routes
Route::get('/doctor', [DoctorController::class,'index'] );
Route::get('/doctor/{id}', [DoctorController::class,'show'] );
Route::post('/doctor', [DoctorController::class,'store'] );
Route::put('/doctor/{id}', [DoctorController::class,'update'] );
Route::delete('/doctor/{id}', [DoctorController::class,'destroy'] );