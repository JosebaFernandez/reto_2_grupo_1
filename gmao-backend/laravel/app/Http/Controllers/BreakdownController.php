<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breakdown;

class BreakdownController
{ 
    public function index()
    {
        $breakdowns = Breakdown::all();
        return response()->json($breakdowns);
    }

    public function store()
    {
        $validatedData = request()->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $averia = Breakdown::create($validatedData);

        return response()->json($averia,201);
    }
}
