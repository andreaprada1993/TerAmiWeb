@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h2 class="text-center mb-4 text-primary">🗃️ Cuentas Eliminadas</h2>

    {{-- Alerta de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    {{-- Si no hay usuarios eliminados --}}
    @if ($usuariosEliminados->isEmpty())
        <div class="text-center">
            <img src="{{ asset('img/sin-usuarios.svg') }}" alt="Sin usuarios" style="max-width: 220px;" class="mb-4">
            <div class="alert alert-info fw-bold">
                No hay cuentas eliminadas en este momento.
            </div>
            <a href="{{ route('home') }}" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left me-1"></i> Volver al Panel
            </a>
        </div>
    @else
        {{-- Tabla con usuarios eliminados --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Celular</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuariosEliminados as $usuario)
                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->celular }}</td>
                            <td class="text-center">
                                <form action="{{ route('admin.restaurar', $usuario->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-undo-alt me-1"></i> Restaurar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
