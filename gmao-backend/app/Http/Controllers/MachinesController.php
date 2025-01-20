<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Machine;

class MachinesController
{
    public function index()
    {
        $machines = Machine::with('section')->get();
        return response()->json($machines);
    }
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'idCampus' => 'required|integer|exists:campuses,idCampus',
            'idSeccion' => 'required|integer|exists:sections,idSeccion',
            'prioridad' => 'required|integer|min:1|max:3',
            'idMaquina' => 'required|integer',
        ]);
        if($validatedData->fails()){
            return response()->json($validatedData->messages(), 400);
            
        }
            

        $machine = Machine::create([
            'nombre' => $request->get('nombre'),
            'idCampus' => $request->get('idCampus'),
            'idSeccion' => $request->get('idSeccion'),
            'prioridad' => $request->get('prioridad'),
            'idMaquina' => $request->get('idMaquina'),
        ]
            
        );

        return response()->json([
            'message' => 'Máquina registrada exitosamente',
            'machine' => $machine,
        ], 201);
    }
}
