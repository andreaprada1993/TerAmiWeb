@extends('layouts.app')
@section('title', 'Seguimiento de Tareas')

@section('content')
    @php
        use Carbon\Carbon;
        $hoy = Carbon::now();
        $inicioMesSeleccionado = Carbon::createFromFormat('Y-m', $mesSeleccionado)->startOfMonth();
        $esMesPasado = $inicioMesSeleccionado->lt($hoy->startOfMonth());
    @endphp
    <div class="mt-3 ms-2">
        <a href="{{ route('home') }}" class="btn btn-light" style="font-size: 1.4rem;">
            ←
        </a>
    </div>


    <div class="container mt-4">
        <h2 class="text-center mb-4">📋 Seguimiento de tus tareas</h2>

        {{-- Filtro por mes --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>📅 Filtrar por mes</h4>
            <form action="{{ route('seguimiento') }}" method="GET" class="d-flex align-items-center">
                <input type="month" name="mes" class="form-control me-2" value="{{ $mesSeleccionado }}">
                <button type="submit" class="btn btn-outline-primary btn-sm">Filtrar</button>
            </form>
        </div>

        {{-- Contadores --}}
        <div class="row text-center mb-3">
            <div class="col-md-4">
                <span class="badge bg-warning text-dark">⏳ Pendientes: {{ $tareasPendientes->count() }}</span>
            </div>
            <div class="col-md-4">
                <span class="badge bg-success">✅ Hechas: {{ $tareasRealizadas->count() }}</span>
            </div>
            <div class="col-md-4">
                <span class="badge bg-danger">❌ Sin Hacer: {{ $tareasSinHacer->count() }}</span>
            </div>
        </div>

        <div class="row">
            {{-- TAREAS PENDIENTES --}}
            <div class="col-md-4">
                <div class="card border-warning mb-4 shadow-sm">
                    <div class="card-header bg-warning text-dark fw-bold">⏳ Tareas Pendientes</div>
                    <div class="card-body">
                        @if($tareasPendientes->count())
                            <ul class="list-group list-group-flush">
                                @foreach($tareasPendientes as $tarea)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $tarea->title }}</strong><br>
                                            <small>{{ Carbon::parse($tarea->start)->format('d/m/Y H:i') }}</small>
                                        </div>
                                        @if(!$esMesPasado)
                                            <div class="d-flex">
                                                <form action="{{ route('evento.realizar', $tarea->id) }}" method="POST" class="me-1">
                                                    @csrf
                                                    <input type="hidden" name="mes" value="{{ request('mes') }}">
                                                    <button class="btn btn-success btn-sm" title="Marcar como realizada">✔</button>
                                                </form>
                                                <form action="{{ route('evento.sin_hacer', $tarea->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="mes" value="{{ request('mes') }}">
                                                    <button class="btn btn-danger btn-sm" title="Marcar como sin hacer">✖</button>
                                                </form>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No hay tareas pendientes.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- TAREAS REALIZADAS --}}
            <div class="col-md-4">
                <div class="card border-success mb-4 shadow-sm">
                    <div class="card-header bg-success text-white fw-bold">✅ Tareas Realizadas</div>
                    <div class="card-body">
                        @if($tareasRealizadas->count())
                            <ul class="list-group list-group-flush">
                                @foreach($tareasRealizadas as $tarea)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $tarea->title }}</strong><br>
                                            <small>{{ Carbon::parse($tarea->start)->format('d/m/Y H:i') }}</small>
                                        </div>
                                        <div class="d-flex">
                                            @if(!$esMesPasado)
                                                <form action="{{ route('evento.pendiente', $tarea->id) }}" method="POST" class="me-1">
                                                    @csrf
                                                    <input type="hidden" name="mes" value="{{ request('mes') }}">
                                                    <button class="btn btn-warning btn-sm" title="Volver a pendiente">↩</button>
                                                </form>
                                            @endif
                                            <form action="{{ route('evento.sin_hacer', $tarea->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="mes" value="{{ request('mes') }}">
                                                <button class="btn btn-danger btn-sm" title="Marcar como sin hacer">✖</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No hay tareas realizadas.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- TAREAS SIN HACER --}}
            <div class="col-md-4">
                <div class="card border-danger mb-4 shadow-sm">
                    <div class="card-header bg-danger text-white fw-bold">❌ Tareas Sin Hacer</div>
                    <div class="card-body">
                        @if($tareasSinHacer->count())
                            <ul class="list-group list-group-flush">
                                @foreach($tareasSinHacer as $tarea)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $tarea->title }}</strong><br>
                                            <small>{{ Carbon::parse($tarea->start)->format('d/m/Y H:i') }}</small>
                                        </div>
                                        @if(!$esMesPasado)
                                            <form action="{{ route('evento.pendiente', $tarea->id) }}" method="POST" class="me-1">
                                                @csrf
                                                <input type="hidden" name="mes" value="{{ request('mes') }}">
                                                <button class="btn btn-warning btn-sm" title="Volver a pendiente">↩</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('evento.realizar', $tarea->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="mes" value="{{ request('mes') }}">
                                            <button class="btn btn-success btn-sm" title="Marcar como realizada">✔</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No hay tareas sin hacer.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- PDF --}}
        <div class="text-end mt-3">
            <a href="{{ route('reporte.avance', ['filtro' => 'mes', 'mes' => $mesSeleccionado]) }}"
                class="btn btn-outline-primary btn-sm">📄 PDF del mes</a>
            <a href="{{ route('reporte.avance', ['filtro' => 'anio']) }}" class="btn btn-outline-secondary btn-sm">📄 PDF
                del año</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection