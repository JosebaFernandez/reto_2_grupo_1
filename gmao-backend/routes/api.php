<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\IncidenceController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BreakdownController;
use App\Http\Controllers\SectionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::controller(AuthController::class)->prefix('auth')->group(function()
{
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->middleware('auth:api');
    Route::post('/refresh', 'refresh')->middleware('auth:api');
    Route::get('/me', 'me')->middleware('auth:api');
});


Route::get('/campuses', [CampusController::class, 'index']);
Route::get('/incidences', [IncidenceController::class, 'index']);
Route::get('/machines', [MachineController::class, 'index']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/breakdowns', [BreakdownController::class, 'index']);
Route::get('/sections', [SectionController::class, 'index']);
Route::get('/tasks', [TaskController::class, 'index']);

//Route::get('/interventions', [InterventionController::class, 'checkActiveIntervention']);

Route::get('/incidences/{idIncidencia}', [IncidenceController::class, 'getIncidencia']);
Route::get('/interventions/{idIncidencia}', [InterventionController::class, 'getIntervenciones']);

Route::post('/incidences/store', [IncidenceController::class, 'store']);
Route::post('/machines/store', [MachineController::class, 'store']);
Route::post('/breakdowns/store', [BreakdownController::class, 'store']);
Route::post('/sections/store', [SectionController::class, 'store']);
Route::post('/tasks/store', [TaskController::class, 'store']);
Route::post('/assign-task', [MaintenanceController::class, 'assignTask']);
Route::post('/campuses/store', [CampusController::class, 'store']);
Route::post('/users/store', [UserController::class, 'store']);
Route::post('/users/cambiarRol/{idUsuario}', [UserController::class, 'cambiarRol']);
Route::post('/users/deshabilitar/{idUsuario}', [UserController::class, 'deshabilitar']);
Route::post('/incidences/deshabilitar/{idIncidencia}', [IncidenceController::class, 'deshabilitar']);
Route::post('/machines/deshabilitar/{idMaquina}', [MachineController::class, 'deshabilitar']);
Route::post('/tasks/deshabilitar/{idTarea}', [TaskController::class, 'deshabilitar']);
Route::post('/interventions', [InterventionController::class, 'store']);

Route::put('/interventions/{idIntervencion}', [InterventionController::class, 'updateIntervention']);

Route::put('/incidences/{idIncidencia}', [IncidenceController::class, 'updateIncidence']);

Route::put('maintenances/{idMaquina}/{idTarea}', [MaintenanceController::class, 'updateMaintenance']);

Route::put('/interventions/{idIntervencion}/leave', [InterventionController::class, 'leaveIntervention']);
Route::post('/interventions/leave/{idIntervencion}', [InterventionController::class, 'leaveIntervention']);
Route::get('/interventions/', [InterventionController::class, 'checkActiveIntervention']);

Route::get('/tasks/find-by-name/{nombre}', [TaskController::class, 'findByName']);



