<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;

class MachinesController
{
    public function index()
    {
        $machines = Machine::all();
        return response()->json($machines);
    }
}
