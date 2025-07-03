@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">👤 Lista de Usuarios Registrados</h2>

    @if ($usuarios->isEmpty())
        <div class="alert alert-info text-center">
            No hay usuarios registrados actualmente.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow-sm">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Celular</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->celular }}</td>
                            <td>{{ ucfirst($usuario->rol) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            ← Volver al panel de administración
        </a>
    </div>
</div>
@endsection
