@extends('layouts.app')

@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="container py-4">
    <h2 class="mb-4">Todas las tareas creadas</h2>
<a href="{{ route('home') }}" class="btn btn-outline-secondary mb-3">
    &#8592; Volver al panel admin
</a>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                    <th>Estado</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tareasConUsuarios as $tarea)
                    <tr>
                        <td>{{ $tarea->title }}</td>
                        <td>{{ $tarea->descripcion }}</td>
                        <td>{{ Carbon::parse($tarea->start)->format('d/m/Y H:i') }}</td>
                        <td>{{ Carbon::parse($tarea->end)->format('d/m/Y H:i') }}</td>
                        <td>{{ ucfirst($tarea->estado) }}</td>
                        <td>{{ $tarea->user ? $tarea->user->name : 'Sin usuario' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay tareas creadas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
