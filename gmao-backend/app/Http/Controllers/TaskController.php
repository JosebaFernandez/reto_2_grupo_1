<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }
}
