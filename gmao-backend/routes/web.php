<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampusController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/campuses', [CampusController::class, 'index']);
