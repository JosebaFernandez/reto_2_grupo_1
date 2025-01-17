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

    public function store() 
    {}
}