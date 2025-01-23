<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidence;
use App\Models\Intervention;

class IncidenceController
{
    public function index()
    {
        $incidencias = Incidence::with(['machine', 'breakdown'])
            ->where('estadoIncidencia', '!=', 'Resuelta')
            ->orderBy('gravedad', 'asc')
            ->join('machines', 'incidences.idMaquina', '=', 'machines.idMaquina')
            ->orderBy('machines.prioridad', 'asc')
            ->orderBy('incidences.fechaReporte', 'asc')
            ->get();

        return response()->json($incidencias);
    }

    public function getIncidencia($idIncidencia)
    {
        $incidencia = Incidence::with(['machine', 'breakdown'])->find($idIncidencia);
        if (!$incidencia) {
            return response()->json(['message' => 'Incidence not found'], 404);
        }
        return response()->json($incidencia);
    }

    public function store(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'idMaquina' => 'required|exists:machines,idMaquina',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'gravedad' => 'required|string',
            'idAveria' => 'required|exists:breakdowns,idAveria',
        ]);

        $validatedData['fechaReporte'] = now()->format('Y-m-d');
        $validatedData['fechaResolucion'] = null;
        $validatedData['estadoIncidencia'] = 'Abierta';
        $validatedData['habilitada'] = true;

        $incidencia = Incidence::create($validatedData);

        $incidencia->load(['machine', 'breakdown']);

        return response()->json($incidencia, 201);
    }
}
