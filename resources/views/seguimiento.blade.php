@extends('layouts.guest')

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
                                        <form action="{{ route('evento.realizar', $tarea->id) }}" method="POST" class="ms-2">
                                            @csrf
                                            <button class="btn btn-success btn-sm" title="Marcar como realizada">✔</button>
                                        </form>
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
                                        <form action="{{ route('evento.sin_hacer', $tarea->id) }}" method="POST" class="ms-2">
                                            @csrf
                                            <button class="btn btn-danger btn-sm" title="Marcar como sin hacer">✖</button>
                                        </form>
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
                                    <li class="list-group-item">
                                        <strong>{{ $tarea->title }}</strong><br>
                                        <small>{{ \Carbon\Carbon::parse($tarea->start)->format('d/m/Y H:i') }}</small>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection