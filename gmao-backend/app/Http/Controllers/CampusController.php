<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;

class CampusController
{
    public function index()
    {
        $campuses = Campus::all();
        return response()->json($campuses);
    }
}
