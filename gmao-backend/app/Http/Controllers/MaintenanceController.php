<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Task;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MaintenanceController
{

    public function assignTask(Request $request)
    {
        try {
            Log::info('Datos recibidos:', $request->all());

            Log::info('Frecuencia recibida:', ['frecuencia' => $request->frecuencia]);
            $validated = $request->validate([
                'taskId' => 'required|exists:tasks,idTarea',
                'machineId' => 'required|exists:machines,idMaquina',
                'frecuencia' => 'required|integer|min:0',
            ]);

            Log::info('Datos validados:', $validated);

            $fechaHoy = now();
            $proximaFecha = $fechaHoy->copy()->addDays($validated['frecuencia']);

            $maintenance = Maintenance::create([
                'idTarea' => $validated['taskId'],
                'idMaquina' => $validated['machineId'],
                'frecuencia' => $validated['frecuencia'],
                'ultimoMantenimiento' => $fechaHoy,
                'proximoMantenimiento' => $proximaFecha,
            ]);

            Log::info('Mantenimiento creado:', $maintenance->toArray());

            return response()->json([
                'message' => 'Tarea asignada correctamente',
                'maintenance' => $maintenance,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error al asignar tarea:', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Error al asignar tarea',
                'details' => $e->getMessage(),
            ], 500);
        }
    }


}

