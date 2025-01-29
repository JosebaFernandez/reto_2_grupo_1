<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Machine;

class MachineController
{
    public function index()
    {
        $machines = Machine::with('section')
                    ->where('habilitada', 1)
                    ->orderBy('machines.prioridad')
                    ->get();
        return response()->json($machines);
    }

    public function store(Request $request)
    {
        $maquinaId = Machine::generarIdMaquina($request->get('idCampus'));

        $machine = Machine::create([
            'idMaquina' => $maquinaId,
            'nombre' => $request->nombre,
            'idCampus' => $request->idCampus,
            'idSeccion' => $request->idSeccion,
            'prioridad' => $request->prioridad,
        ]);

        return response()->json(Machine::with('section')->find($maquinaId));
    }

    public function deshabilitar($idMaquina)
    {
        $machine = Machine::find($idMaquina);
        $machine->habilitada = 0;
        $machine->save();
        return response()->json($machine);
    }
}
