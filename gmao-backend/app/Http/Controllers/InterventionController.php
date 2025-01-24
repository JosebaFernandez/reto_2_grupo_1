<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intervention;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class InterventionController
{
    public function getIntervenciones($idIncidencia)
    {
        $intervenciones = Intervention::with('tecnico')->where('idIncidencia', $idIncidencia)->get();
        return response()->json($intervenciones);
    }
    public function store(Request $request)
    {
        // Convierte 'fechaInicio' al formato esperado por MySQL
        $fechaInicio = Carbon::parse($request->input('fechaInicio'))->toDateTimeString();
        $request->merge(['fechaInicio' => $fechaInicio]);

        // Si 'fechaFin' también puede venir en formato ISO, conviértelo también
        if ($request->input('fechaFin')) {
            $fechaFin = Carbon::parse($request->input('fechaFin'))->toDateTimeString();
            $request->merge(['fechaFin' => $fechaFin]);
        }

        // Validar los datos recibidos
        $validated = $request->validate([
            'idTecnico' => 'required|exists:users,idUsuario',
            'idIncidencia' => 'required|exists:incidences,idIncidencia',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'nullable|date',
            'notas' => 'nullable|string',
        ]);

        // Crear la intervención en la base de datos
        $intervention = Intervention::create($validated);


        return response()->json($intervention, 201);
    }

    public function checkActiveIntervention(Request $request)
    {
        // Recuperar los parámetros 'userId' y 'incidentId' enviados en la solicitud GET
        $userId = $request->query('userId');
        $incidentId = $request->query('incidentId');

        // Buscar una intervención activa para el técnico (idTecnico) en la incidencia (idIncidencia)
        $intervention = Intervention::where('idTecnico', $userId)
            ->where('idIncidencia', $incidentId)
            ->whereNull('fechaFin') // Comprobar que la intervención aún esté activa
            ->first();

        // Retornar la respuesta en formato JSON con los datos de la intervención activa, si existe
        if ($intervention) {
            return response()->json([
                'active' => true,
                'intervention' => $intervention
            ]);
        } else {
            return response()->json([
                'active' => false
            ]);
        }
    }



}
