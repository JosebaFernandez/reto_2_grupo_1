<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\IncidenceController;
use App\Http\Controllers\MachinesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\AuthController;


use App\Http\Controllers\BreakdownController;
use App\Http\Controllers\SectionController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->prefix('auth')->group(function()
{
Route::post('login', 'login');
Route::post('register', 'register');
Route::post('logout', 'logout')->middleware('auth:api');
Route::post('refresh', 'refresh')->middleware('auth:api');
Route::get('me', 'me')->middleware('auth:api');
});

Route::get('/campuses', [CampusController::class, 'index']);
Route::get('/incidences', [IncidenceController::class, 'index']);
Route::get('/machines', [MachinesController::class, 'index']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/breakdowns', [BreakdownController::class, 'index']);
Route::get('/sections', [SectionController::class, 'index']);
Route::get('/tasks', [TaskController::class, 'index']);

Route::get('/incidences/{idIncidencia}', [IncidenceController::class, 'getIncidencia']);
Route::get('/interventions/{idIncidencia}', [InterventionController::class, 'getIntervenciones']);

Route::post('/incidences/store', [IncidenceController::class, 'store']);
Route::post('/machines/store', [MachinesController::class, 'store']);
Route::post('/breakdowns/store', [BreakdownController::class, 'store']);
Route::post('/sections/store', [SectionController::class, 'store']);
Route::post('/tasks/store', [TaskController::class, 'store']);
Route::post('/assign-task', [MaintenanceController::class, 'assignTask']);
Route::post('/campuses/store', [CampusController::class, 'store']);
Route::post('/users/store', [UserController::class, 'store']);

