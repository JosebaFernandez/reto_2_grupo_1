<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController
{
    public function index()
    {
        $sections = Section::all();
        return response()->json($sections);
        
    }

    public function store(Request $request)
    {

        $idSeccion = Section::generarIdSeccion($request->idCampus);

        $seccion = Section::create([
            'idSeccion' => $idSeccion,
            'nombre' => $request->nombre,
        ]);

        return response()->json($seccion); 
    }
}
