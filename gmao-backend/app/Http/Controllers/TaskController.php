<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TaskController
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
        ]);
        if($validatedData->fails()){
            return response()->json($validatedData->messages(), 400);
        }


        $task = Task::create([
                'nombre' => $request->get('nombre'),
                'descripcion' => $request->get('descripcion'),
            ]

        );

        return response()->json([
            'message' => 'Tarea registrada exitosamente',
            'task' => $task,
        ], 201);
    }
}
