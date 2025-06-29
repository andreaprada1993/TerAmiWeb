@extends('layouts.app')

@section('content')
<style>
    html, body, #app {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        background-image: linear-gradient(135deg, #c8c6ff, #f8e1ff, #d1ecff), url('{{ asset('img/fondoLogin.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        font-family: 'Segoe UI', sans-serif;
    }

    .glass-card {
        background-color: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        color: #212529;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    .form-control {
        background-color: #ffffffd0 !important;
        color: #212529 !important;
        border: 1px solid #ced4da;
    }

    .form-control::placeholder {
        color: #6c757d;
    }

    .card-header {
        background: transparent;
        border-bottom: none;
        font-size: 1.8rem;
        font-weight: bold;
        text-align: center;
        color: #343a40;
    }

    label {
        color: #212529;
    }

    .text-danger {
        font-size: 0.9rem;
    }

    .btn-primary {
        background-color: #6f42c1;
        border: none;
    }

    .btn-primary:hover {
        background-color: #5a379e;
    }

    .login-link p {
        color: #343a40;
        font-size: 0.95rem;
    }

    .login-link a {
        color: #6f42c1;
        text-decoration: none;
        font-weight: bold;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    .logo-top {
        text-align: center;
        margin-bottom: 1rem;
    }

    .logo-top img {
        width: 110px;
        opacity: 0.95;
    }
</style>

<div class="container h-100 d-flex justify-content-center align-items-center">
    <div class="row justify-content-center w-100">
        <div class="col-md-10 col-lg-8">
            <div class="card p-4 glass-card">
                <!-- Logo -->
                <div class="logo-top">
                    <img src="{{ asset('img/logo.png') }}" alt="TerAmi Logo">
                </div>

                <div class="card-header">Registro</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Correo Electrónico</label>
                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirmar Contraseña</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password"
                                    class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    Registrar
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
