<?php

use Illuminate\Support\Facades\Route;

Route::get('/patient-route', function () {
    return 'This is a patient route!';
});