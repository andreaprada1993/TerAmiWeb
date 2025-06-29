<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - TerAmi</title>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-image: linear-gradient(135deg, #c8c6ff, #f8e1ff, #d1ecff), url('{{ asset('img/fondoLogin.png') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }

    .login-card {
      background-color: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 420px;
      color: #212529;
    }

    .login-card h3 {
      font-weight: 700;
      color: #343a40;
    }

    .form-control {
      background-color: #ffffffd0;
      border: 1px solid #ced4da;
      color: #212529;
    }

    .form-control::placeholder {
      color: #6c757d;
    }

    .form-label {
      color: #212529;
    }

    .form-check-label {
      color: #212529;
    }

    .invalid-feedback {
      color: #dc3545;
    }

    .btn-light {
      background-color: #fff;
      color: #6f42c1;
      font-weight: bold;
    }

    .btn-link,
    .text-light {
      color: #6f42c1;
      text-decoration: none;
    }

    .btn-link:hover,
    .text-light:hover {
      text-decoration: underline;
    }

    .logo-top {
      text-align: center;
      margin-bottom: 1rem;
    }

    .logo-top img {
      width: 120px;
      opacity: 0.9;
    }

    @media (max-width: 576px) {
      .login-card {
        margin: 1rem;
        padding: 1.5rem;
      }

      .logo-top img {
        width: 90px;
      }
    }
  </style>
</head>

<body>
  <div class="login-card">
    <!-- Logo -->
    <div class="logo-top">
      <img src="{{ asset('img/logo.png') }}" alt="TerAmi Logo">
    </div>

    <h3 class="text-center mb-4">Iniciar Sesión</h3>
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
        <button type="submit" class="btn btn-light text-dark">Ingresar</button>
      </div>

      <div class="d-flex justify-content-center">
        @if (Route::has('password.request'))
          <a class="btn btn-link" href="{{ route('password.request') }}">
            ¿Olvidaste tu contraseña?
          </a>
        @endif
      </div>
      <div class="text-center mt-2">
    <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
</div>

      <div class="text-center mt-2">
        <a href="{{ route('register') }}" class="text-light">¿No tienes cuenta? Regístrate</a>
      </div>
    </form>
  </div>
</body>

</html>
