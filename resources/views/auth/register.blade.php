@extends('layouts.app')

@section('content')
<style>
    html, body, #app {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        background-image: url('{{ asset('img/fondoLogin.png') }}');
        background-size: ;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .glass-card {
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        color: white;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    }

    .form-control {
        background-color: transparent !important;
        color: white !important;
        border-color: white;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .card-header {
        background: transparent;
        border-bottom: none;
        font-size: 1.8rem;
        font-weight: bold;
        text-align: center;
    }

    .text-danger {
        font-size: 0.9rem;
    }

    label {
        color: white;
    }

    .btn-primary {
        background-color: #4a90e2;
        border: none;
    }

    .btn-primary:hover {
        background-color: #357ab8;
    }
</style>

<div class="container h-100 d-flex justify-content-center align-items-center">
    <div class="row justify-content-center w-100">
        <div class="col-md-10 col-lg-8">
            <div class="card p-4 glass-card">
                <div class="card-header">Registro</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password"
                                    class="form-control" name="password_confirmation"
                                    required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                             <div class="login-link text-center mt-3">
                            <p>¿Ya estás registrado? <a href="{{ route('login') }}">Inicia sesión</a></p>
                        </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
