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
}
