<?php

use Illuminate\Support\Facades\Route;

Route::get('/doctor-route', function () {
    return 'This is a doctor route!';
});