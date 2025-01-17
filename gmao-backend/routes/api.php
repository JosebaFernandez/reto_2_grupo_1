<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\IncidenceController;
use App\Http\Controllers\MachinesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InterventionController;

use App\Http\Controllers\BreakdownController;
use App\Http\Controllers\SectionController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/campuses', [CampusController::class, 'index']);
Route::get('/incidences', [IncidenceController::class, 'index']);
Route::get('/machines', [MachinesController::class, 'index']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/breakdowns', [BreakdownController::class, 'index']);

Route::get('/incidences/{idIncidencia}', [IncidenceController::class, 'getIncidencia']);
Route::get('/interventions/{idIncidencia}', [InterventionController::class, 'getIntervenciones']);

Route::get('/sections', [SectionController::class, 'index']);

Route::post('/incidences/store', [IncidenceController::class, 'store']);