@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel de Administración</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gestión de Usuarios</h5>
                    <p class="card-text">Administra los usuarios del sistema</p>
                    <a href="{{ route('admin.usuarios') }}" class="btn btn-primary">Ver Usuarios</a>
                </div>
            </div>
        </div>
        <!-- Más cards con funcionalidades de admin -->
    </div>
</div>
@endsection 