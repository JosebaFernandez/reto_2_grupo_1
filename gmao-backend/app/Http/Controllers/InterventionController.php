<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intervention;

class InterventionController extends Controller
{
    public function getInterventionsByIncidencia($idIncidencia)
    {
        $interventions = Intervention::where('idIncidencia', $idIncidencia)->get();
        return response()->json($interventions);
    }
}
