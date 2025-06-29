@extends('layouts.app')
@section('title', 'Seguimiento de Tareas')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">📋 Seguimiento de tus tareas</h2>

        <div class="row">
            {{-- Tareas Pendientes --}}
            <div class="col-md-4">
                <div class="card border-warning shadow-sm mb-4">
                    <div class="card-header bg-warning text-dark fw-bold">
                        ⏳ Tareas Pendientes
                    </div>
                    <div class="card-body">
                        @if($tareasPendientes->count())
                            <ul class="list-group list-group-flush">
                                @foreach($tareasPendientes as $tarea)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $tarea->title }}</strong><br>
                                            <small>{{ \Carbon\Carbon::parse($tarea->start)->format('d/m/Y H:i') }}</small>
                                        </div>
                                        <div class="d-flex">
                                            {{-- Realizada --}}
                                            <form action="{{ route('evento.realizar', $tarea->id) }}" method="POST" class="me-1">
                                                @csrf
                                                <button class="btn btn-success btn-sm" title="Marcar como realizada">✔</button>
                                            </form>

                                            {{-- No realizada --}}
                                            <form action="{{ route('evento.sin_hacer', $tarea->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-danger btn-sm" title="Marcar como no realizada">✖</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No hay tareas pendientes.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Tareas Realizadas --}}
            <div class="col-md-4">
                <div class="card border-success shadow-sm mb-4">
                    <div class="card-header bg-success text-white fw-bold">
                        ✅ Tareas Realizadas
                    </div>
                    <div class="card-body">
                        @if($tareasRealizadas->count())
                            <ul class="list-group list-group-flush">
                                @foreach($tareasRealizadas as $tarea)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $tarea->title }}</strong><br>
                                            <small>{{ \Carbon\Carbon::parse($tarea->start)->format('d/m/Y H:i') }}</small>
                                        </div>
                                        <div class="d-flex">
                                            {{-- Botón para marcar como sin hacer --}}
                                            <form action="{{ route('evento.sin_hacer', $tarea->id) }}" method="POST" class="me-1">
                                                @csrf
                                                <button class="btn btn-danger btn-sm" title="Marcar como sin hacer">✖</button>
                                            </form>

                                            {{-- Botón para devolver a pendiente --}}
                                            <form action="{{ route('evento.pendiente', $tarea->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-warning btn-sm" title="Devolver a pendiente">⏳</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Aún no hay tareas realizadas.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Tareas Sin Hacer --}}
            <div class="col-md-4">
                <div class="card border-danger shadow-sm mb-4">
                    <div class="card-header bg-danger text-white fw-bold">
                        ❌ Tareas Sin Hacer
                    </div>
                    <div class="card-body">
                        @if($tareasSinHacer->count())
                            <ul class="list-group list-group-flush">
                                @foreach($tareasSinHacer as $tarea)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $tarea->title }}</strong><br>
                                            <small>{{ \Carbon\Carbon::parse($tarea->start)->format('d/m/Y H:i') }}</small>
                                        </div>
                                        <div class="d-flex">
                                            {{-- Botón para marcar como realizada --}}
                                            <form action="{{ route('evento.realizar', $tarea->id) }}" method="POST" class="me-1">
                                                @csrf
                                                <button class="btn btn-success btn-sm" title="Marcar como realizada">✔</button>
                                            </form>

                                            {{-- Botón para devolver a pendiente --}}
                                            <form action="{{ route('evento.pendiente', $tarea->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-warning btn-sm" title="Devolver a pendiente">⏳</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">¡Todo al día! 🥳</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4 text-end">
        <a href="{{ route('reporte.avance') }}" class="btn btn-lg btn-outline-primary shadow-sm rounded-pill px-4 py-2"
            target="_blank">
            📄 Generar Reporte de Avance
        </a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection