<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidence;
use App\Models\Intervention;

class IncidenceController
{
    public function index()
    {
        $incidencias = Incidence::all();
        return response()->json($incidencias);
    }

    public function view($idIncidencia)
    {
        $incidencia = Incidence::find($idIncidencia);

        if ($incidencia) {

            $intervenciones = Intervention::where('idIncidencia', $idIncidencia)->get();

            return response()->json(
            [
            'incidencia' => $incidencia,
            'intervenciones' => $intervenciones
            ]);

        } else return response()->json(['error' => 'Incidencia no encontrada'], 404);
    } 
}