<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intervention;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InterventionController
{
    // Existing method to get interventions
    public function getIntervenciones($idIncidencia)
    {
        $intervenciones = Intervention::with('tecnico')->where('idIncidencia', $idIncidencia)->get();
        return response()->json($intervenciones);
    }

    // Existing method to store interventions
    public function store(Request $request)
    {
        $fechaInicio = Carbon::parse($request->input('fechaInicio'))->toDateTimeString();
        $request->merge(['fechaInicio' => $fechaInicio]);

        if ($request->input('fechaFin')) {
            $fechaFin = Carbon::parse($request->input('fechaFin'))->toDateTimeString();
            $request->merge(['fechaFin' => $fechaFin]);
        }

        $validated = $request->validate([
            'idTecnico' => 'required|exists:users,idUsuario',
            'idIncidencia' => 'required|exists:incidences,idIncidencia',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'nullable|date',
            'notas' => 'nullable|string',
        ]);

        $intervention = Intervention::create($validated);

        return response()->json($intervention, 201);
    }

    // Check if a user has an active intervention
    public function checkActiveIntervention(Request $request)
    {
        $userId = $request->query('userId');

        $intervention = Intervention::where('idTecnico', $userId)
            ->whereNull('fechaFin') // Active intervention
            ->first();

        if ($intervention) {
            return response()->json([
                'active' => true,
                'intervention' => $intervention,
            ]);
        }

        return response()->json(['active' => false]);
    }

    // Leave an intervention (mark it as completed)
    public function leaveIntervention(Request $request, $idIntervencion)
    {
        $intervention = Intervention::find($idIntervencion);

        if (!$intervention || $intervention->fechaFin) {
            return response()->json(['error' => 'Intervention not found or already closed'], 400);
        }

        $validated = $request->validate([
            'fechaFin' => 'required|date',
            'motivo' => 'required|string|max:255',
            'notas' => 'nullable|string',
        ]);

        // Update the intervention with the new data
        $intervention->update($validated);

        return response()->json(['message' => 'Intervention closed successfully', 'intervention' => $intervention]);
    }

    // New method to update an intervention
    public function updateIntervention(Request $request, $idIntervencion)
    {
        // Get the date and time string from the request
        $fechaFin = Carbon::parse($request->input('fechaFin'))->format('Y-m-d H:i:s');

        // Update the intervention record
        $intervention = Intervention::where('idIntervencion', $idIntervencion)->first();

        if (!$intervention) {
            return response()->json(['error' => 'Intervention not found'], 404);
        }

        // Update the intervention details
        $intervention->update([
            'fechaFin' => $fechaFin,
            'notas' => $request->input('notas'),
            'motivo' => $request->input('motivo'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return response()->json(['message' => 'Intervention updated successfully', 'intervention' => $intervention]);
    }
}
