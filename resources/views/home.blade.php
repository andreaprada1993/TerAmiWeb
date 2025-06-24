{{-- Este es el inicio de la pagina --}}
@extends('layouts.app')

@section('content')
@section('title', 'Dashboard')

<div class="container mt-5">

    {{-- Bienvenida --}}
    <div class="text-center mb-4">
        <img src="{{ asset('img/mapacheLogo.png') }}" alt="Logo TerAmi" height="80">
        <h1 class="mt-3">¡Bienvenido a TerAmi!</h1>
    </div>

    {{-- Card de Tareas Pendientes --}}
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            📌 Tareas Pendientes
        </div>
        <div class="card-body">
            @if($tareasPendientes->count())
                <ul class="list-group">
                    @foreach($tareasPendientes as $tarea)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{-- Enlace a calendario --}}
                            <a href="{{ route('evento.index') }}" class="text-decoration-none text-dark">
                                {{ $tarea->title }}
                            </a>
                            <span class="badge bg-info text-dark">
                                {{ \Carbon\Carbon::parse($tarea->start)->format('d/m/Y H:i') }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No tienes tareas pendientes.</p>
            @endif
        </div>
    </div>

</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection