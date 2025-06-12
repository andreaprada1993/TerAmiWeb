{{-- Este es el inicio de la pagina --}}
@extends('layouts.app')

@section('content')
@section('title', 'Dashboard')


{{-- la bienvenida de la pagina--}}
    <div class="container text-center mt-9">
        <img src="{{ asset('img/mapacheLogo.png') }}" height="60" alt="TerAmi Logo">
        <h1 class="mt-3">{{ config('Bienvenido!', 'TerAmi') }}</h1>
    </div>

{{-- Este es la card de notificaciones--}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header">{{ __('Notificacion') }}</div>{{-- cambia el nombre visual dela pagina--}}
                    {{-- la ruta de la card--}}
                    <div class="card" onclick="window.location='{{ route('evento.index') }}'" style="cursor: pointer;">
                        <div class="card-body">Ir a eventos</div>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- Esta es la card de la IA--}}
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Auxiliar IA') }}</div>{{-- cambia el nombre visual dela pagina --}}

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection