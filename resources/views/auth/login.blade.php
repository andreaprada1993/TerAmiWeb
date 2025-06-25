<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TerAmi</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            background-image: url('{{ asset('img/fondoLogin.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            /* <- hace que no se mueva al hacer scroll */
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            color: white;
            width: 100%;
            max-width: 500px;
        }

        .login-card .form-control {
            background-color: rgba(255, 255, 255, 0.3);
            border: none;
            color: #fff;
        }

        .login-card .form-control::placeholder {
            color: #eee;
        }

        .login-card .form-label {
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h3 class="text-center mb-4">Iniciar Sesion</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input id="email" type="email" placeholder="correo@example.com"
                    class="form-control @error('email') is-invalid @enderror" name="email" required autofocus>
                @error('email')
                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" type="password" placeholder="********"
                    class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Recordarme</label>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-light text-dark fw-bold">Ingresar</button>
            </div>
            <div class="d-flex justify-content-center">
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
            </div>
            <div class="text-center">
                <a href="{{ route('register') }}" class="text-light">¿No tienes cuenta? Regístrate</a>
            </div>
        </form>
    </div>
</body>

</html>