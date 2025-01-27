@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel de Operario</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-title">Órdenes de Trabajo</div>
                <div class="card-body">
                    <p>Gestiona las órdenes de trabajo</p>
                    <a href="{{ route('operario.ordenes') }}" class="btn btn-primary">Ver Órdenes</a>
                </div>
            </div>
        </div>
        <!-- Más cards con funcionalidades de operario -->
    </div>
</div>
@endsection 