<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TaskController
{
    public function index()
    {
        $tasks = Task::where('habilitada', 1)
                     ->get();
        return response()->json($tasks);
    }
    public function store(Request $request)
    {

        $task = Task::create([
                'nombre' => $request->get('nombre'),
                'descripcion' => $request->get('descripcion'),
            ]

        );

        return response()->json($task, 201);
    }
    public function deshabilitar($idTarea)
    {
        $task = Task::find($idTarea);
        $task->habilitada = 0;
        $task->save();
        return response()->json($task);
    }
}

