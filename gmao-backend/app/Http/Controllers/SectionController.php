<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController
{
    public function index()
    {
        $sections = Section::all();
        return response()->json($sections);
        
    }
}
