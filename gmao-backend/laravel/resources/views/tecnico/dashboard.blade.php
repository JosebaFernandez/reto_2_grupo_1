@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel de Técnico</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-title">Mis Tareas</div>
                <div class="card-body">
                    <p>Visualiza y gestiona tus tareas asignadas</p>
                    <a href="{{ route('tecnico.tareas') }}" class="btn btn-primary">Ver Tareas</a>
                </div>
            </div>
        </div>
        <!-- Más cards con funcionalidades de técnico -->
    </div>
</div>
@endsection 