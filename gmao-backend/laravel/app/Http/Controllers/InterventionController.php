<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intervention;

class InterventionController
{
    public function getIntervenciones($idIncidencia)
    {
        $intervenciones = Intervention::with('tecnico')->where('idIncidencia', $idIncidencia)->get();
        return response()->json($intervenciones);
    }
}
