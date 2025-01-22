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
       
        $task = Task::create([
                'nombre' => $request->get('nombre'),
                'descripcion' => $request->get('descripcion'),
            ]

        );

        return response()->json($task, 201);
    }
}
