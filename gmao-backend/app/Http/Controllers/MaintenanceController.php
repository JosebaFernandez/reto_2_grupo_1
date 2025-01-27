<?php

namespace App\Http\Controllers;

use App\Models\Incidence;
use App\Models\Maintenance;
use App\Models\Task;
use App\Models\Machine;
use Carbon\Carbon;
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
    public function updateMaintenance(Request $request, $idMaquina, $idTarea)
    {
        Log::info('Datos recibidos en updateMaintenance:', ['idMaquina' => $idMaquina, 'idTarea' => $idTarea]);

        // Buscar el registro de mantenimiento
        $maintenance = Maintenance::where('idMaquina', $idMaquina)
            ->where('idTarea', $idTarea)
            ->first();

        if (!$maintenance) {
            return response()->json(['error' => 'Maintenance not found'], 404);
        }

        $fechaHoy = Carbon::now(); // Fecha actual
        $proximaFecha = $fechaHoy->copy()->addDays($maintenance->frecuencia); // Calcula la nueva fecha

        try {
            // Actualizar el registro de mantenimiento
            $maintenance->update([
                'ultimoMantenimiento' => $fechaHoy->format('Y-m-d'), // Guardar en formato "YYYY-MM-DD"
                'proximoMantenimiento' => $proximaFecha->format('Y-m-d'), // Guardar en formato "YYYY-MM-DD"
                'updated_at' => $fechaHoy->format('Y-m-d H:i:s'), // Fecha y hora actualizada
            ]);

            Log::info('Mantenimiento actualizado:', $maintenance->toArray());
            return response()->json(['message' => 'Maintenance updated successfully', 'maintenance' => $maintenance]);
        } catch (\Exception $e) {
            Log::error('Error actualizando el mantenimiento:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error actualizando el mantenimiento', 'details' => $e->getMessage()], 500);
        }
    }



}

