<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Medicine_AlertController;
use App\Models\Patient;

Route::get('/patient-route', function () {
    return 'This is a patient route!';
    
});
Route::get('/patients',[PatientController::class,'index'])->name('patients');
Route::get('/patients/{id}',[PatientController::class,'show'])
->name('show');
Route::post('/patients',function(){
    return Patient::create([
        'first_name'=> 'Johnv',
        'last_name'=> 'Doeb',
        "username"=> "johndoeb",
        "password"=>"secretb",
        "gender"=> "Malef",
        "national_id"=> 1234567895,
        "email"=> "john.doe@example.comg",
        "Address"=> "123 Main Sthg",
        "birth_date"=> "1990-01-011",
        "phone_number"=> 123456784,
        "Personal_image"=> "path/to/image.jpg"
    ]);
});
// Route::post('/pateints',[PatientController::class,'store'])->name('store');
Route::put('/pateints/{id}/update',[PatientController::class,'update'])->name('update');
Route::put('/pateints/{id}/delete',[PatientController::class,'destroy'])->name('destroy');
///////////////////////////////////////////////////////
Route::get('/medicine-alerts', [Medicine_AlertController::class, 'index']);
Route::get('/medicine-alerts/{id}', [Medicine_AlertController::class, 'show']);
Route::post('/medicine-alerts', [Medicine_AlertController::class, 'store']);
Route::put('/medicine-alerts/{id}', [Medicine_AlertController::class, 'update']);
Route::delete('/medicine-alerts/{id}', [Medicine_AlertController::class, 'destroy']);