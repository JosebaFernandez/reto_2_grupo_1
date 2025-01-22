<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public function index()
    {
        $users = User::where('habilitado', 1)
                     ->orderBy('rol')
                     ->orderBy('nombre')
                     ->get();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'rol' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->messages(), 400);
        }

        $user = User::create([
            'nombre' => $request->get('nombre'),
            'apellido' => $request->get('apellido'),
            'rol' => $request->get('rol'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'habilitado' => 1, 
        ]);

        return response()->json($user, 201);
    }

    public function cambiarRol(Request $request, $idUsuario)
    {
        $user = User::find($idUsuario);
        $user->rol = $request->rol;
        $user->save();
        return response()->json($user);
    }

    public function deshabilitar($idUsuario)
    {
        $user = User::find($idUsuario);
        $user->habilitado = 0;
        $user->save();
        return response()->json($user);
    }
    
}
