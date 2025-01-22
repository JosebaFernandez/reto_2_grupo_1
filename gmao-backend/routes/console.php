<?php

use App\Models\Incidence;
use App\Models\Machine;
use App\Models\Maintenance;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::call(function () {
    try{

    // Obtener todos los mantenimientos cuyo próximo mantenimiento sea hoy
    $dueMaintenances = Maintenance::whereDate('proximoMantenimiento', Carbon::today())->get();
    //dd($dueMaintenances);

    foreach ($dueMaintenances as $maintenance) {
        // Obtener los datos de la tarea y la máquina
        $task = Task::find($maintenance->idTarea);
        $machine = Machine::find($maintenance->idMaquina);
        // Definir el tipo de incidencia
        $incidentType = '4';
        $breakdownType = '8';
        $incidentState = "Pendiente";

        if (!$machine) {
            \Log::error("Máquina no encontrada para el mantenimiento ID: {$maintenance->idMantenimiento}, ID de la máquina: {$maintenance->idMaquina}");
            continue;
            }

        if (!$task) {
            \Log::error("Tarea no encontrada para el mantenimiento ID: {$maintenance->idMantenimiento}, ID de la tarea: {$maintenance->idTarea}");
            continue;
            }

        // Crear la incidencia
        $indicencia = Incidence::create([
            'idMaquina' => $machine->idMaquina,
            'gravedad' => $incidentType,
            'idAveria' => $breakdownType,
            'descripcion' => $task->descripcion,
            'fechaReporte' => Carbon::today(),
            'titulo' => $task->nombre,
            'estadoIncidencia' => $incidentState,
            'habilitada' => 1

            ]);
        \Log::debug($indicencia);
        }
    }catch (\Exception $e){
        dd($e->getMessage());
    }
})->everyMinute();
