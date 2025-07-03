{{-- Este es el inicio de la página --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container mt-5">

     @if(Auth::user()->rol === 'admin')
            <h2>Bienvenido, Administrador</h2>
            <p>Aquí puedes gestionar usuarios, revisar actividades, etc.</p>
        @else
            <h2 class="text-primary">¡Hola {{ Auth::user()->name }}!</h2>
            <p class="text-muted">Aquí verás tus tareas y avances.</p>
        @endif



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
                @if($tareasPendientes->isEmpty())
                    <p class="text-muted">No tienes tareas pendientes.</p>
                @else
                    <ul class="list-group">
                        @foreach($tareasPendientes as $tarea)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $tarea->title }}</strong><br>
                                    <small class="text-muted">
                                        Fecha: {{ \Carbon\Carbon::parse($tarea->start)->format('d/m/Y H:i') }}
                                    </small>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
       
        {{-- llamando a chatbot
        @include('components.chatbot')--}}

        {{-- Botón para agregar nueva tarea --}}
        <div class="text-center mt-3">
            <a href="{{ route('evento.index') }}" class="btn btn-success btn-lg">
                ➕ Agregar Nueva Tarea
            </a>
        </div>

        {{-- Botón para ir al seguimiento --}}
        <div class="text-center mt-4">
            <a href="{{ route('seguimiento') }}" class="btn btn-outline-primary btn-lg">
                📊 Ver Seguimiento de Tareas
            </a>
        </div>

    </div>
@endsection
{{-- Bootstrap JS necesario para el menú --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@section('scripts')
    <script src="{{ asset('js/chatbot.js') }}"></script>
    <script src="{{ asset('js/agenda.js') }}"></script>
@endsection