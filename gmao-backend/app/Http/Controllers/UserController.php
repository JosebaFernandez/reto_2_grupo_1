<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\Task;


class UserController
{
    public function getUsuario($idUsuario) {
        $response = User::find($idUsuario);
        return response()->json($response);
    }
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

    public function adminDashboard()
    {
        // Solo accesible para administradores
        return view('admin.dashboard');
    }

    public function operarioDashboard()
    {
        // Solo accesible para operarios
        return view('operario.dashboard');
    }

    public function tecnicoDashboard()
    {
        // Solo accesible para técnicos
        return view('tecnico.dashboard');
    }

    public function dashboard()
    {
        // Accesible para usuarios normales y administradores
        return view('dashboard');
    }

    public function adminDashboardData()
    {
        return response()->json([
            'title' => 'Panel de Administración',
            'stats' => [
                'total_users' => User::count(),
                'active_orders' => Order::where('status', 'active')->count(),
                // otros datos relevantes
            ],
            'recent_activities' => [
                // datos de actividades recientes
            ]
        ]);
    }

    public function operarioDashboardData()
    {
        return response()->json([
            'title' => 'Panel de Operario',
            'orders' => [
                'pending' => Order::where('status', 'pending')->count(),
                'in_progress' => Order::where('status', 'in_progress')->count(),
            ],
            'recent_orders' => Order::latest()->take(5)->get()
        ]);
    }

    public function tecnicoDashboardData()
    {
        return response()->json([
            'title' => 'Panel de Técnico',
            'tasks' => [
                'assigned' => Task::where('technician_id', auth()->id())
                                ->where('status', 'pending')
                                ->get(),
                'in_progress' => Task::where('technician_id', auth()->id())
                                    ->where('status', 'in_progress')
                                    ->get()
            ]
        ]);
    }
}
