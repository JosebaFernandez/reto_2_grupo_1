<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <!-- Incluye tus estilos CSS aquí -->
</head>
<body>
    <nav class="navbar">
        <!-- Menú de navegación que cambia según el rol -->
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.usuarios') }}">Usuarios</a>
            @elseif(auth()->user()->role === 'operario')
                <a href="{{ route('operario.dashboard') }}">Dashboard</a>
                <a href="{{ route('operario.ordenes') }}">Órdenes</a>
            @elseif(auth()->user()->role === 'tecnico')
                <a href="{{ route('tecnico.dashboard') }}">Dashboard</a>
                <a href="{{ route('tecnico.tareas') }}">Tareas</a>
            @endif
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Cerrar Sesión</button>
            </form>
        @endauth
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Incluye tus scripts JS aquí -->
</body>
</html> 