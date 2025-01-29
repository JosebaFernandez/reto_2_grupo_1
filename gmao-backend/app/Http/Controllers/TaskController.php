<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController
{
    public function index()
    {
        $tasks = Task::where('habilitada', 1)->get();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        // Validar que el nombre sea único
        $validatedData = $request->validate([
            'nombre' => 'required|string|unique:tasks,nombre',
            'descripcion' => 'required|string',
        ]);
        $validatedData['habilitada'] = 1;

        $task = Task::create($validatedData);

        return response()->json($task, 201);
    }
    public function findByName($nombre)
    {
        \Log::info("Buscando tarea con nombre: $nombre");

        $task = Task::where('nombre', $nombre)->first();

        if ($task) {
            return response()->json($task);
        }

        return response()->json(['message' => 'Task not found'], 404);
    }


    public function deshabilitar($idTarea)
    {
        $task = Task::find($idTarea);
        $task->habilitada = 0;
        $task->save();
        return response()->json($task);
    }
}
