<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;

class MachinesController
{
    public function index()
    {
        $machines = Machine::with('section')->get();
        return response()->json($machines);
    }
}
