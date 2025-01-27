<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;

class CampusController
{
    public function index()
    {
        $campuses = Campus::all();
        return response()->json($campuses);
    }

    public function store(Request $request)
    {
        $lastCampus = Campus::orderBy('idCampus', 'desc')->first();
        $newId = $lastCampus ? $lastCampus->idCampus + 1 : 1;

        $campus = new Campus();
        $campus->idCampus = $newId;
        $campus->nombre = $request->nombre;
        $campus->save();

        return response()->json($campus, 201);
    }
}
