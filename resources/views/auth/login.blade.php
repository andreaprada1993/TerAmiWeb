<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - TerAmi</title>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      min-height: 100vh;
      background: linear-gradient(135deg, #c8c6ff, #f8e1ff, #d1ecff);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-wrapper {
      width: 100%;
      max-width: 380px;
      background-color: white;
      border-radius: 1rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      margin: 1rem;
    }

    .logo {
      display: block;
      margin: 0 auto 1.5rem;
      width: 100px;
    }

    h2 {
      text-align: center;
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
      color: #6f42c1;
    }

    .form-control {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 0.5rem;
      margin-bottom: 1rem;
      font-size: 1rem;
    }

    .form-label {
      margin-bottom: 0.25rem;
      font-weight: 500;
      font-size: 0.95rem;
      color: #212529;
    }

    .btn-login {
      width: 100%;
      padding: 0.75rem;
      background-color: #6f42c1;
      border: none;
      color: white;
      font-size: 1rem;
      border-radius: 0.5rem;
      margin-bottom: 1rem;
    }

    .btn-login:hover {
      background-color: #59359f;
    }

    .text-small {
      font-size: 0.9rem;
      text-align: center;
    }

    .text-small a {
      color: #6f42c1;
      text-decoration: none;
    }

    .text-small a:hover {
      text-decoration: underline;
    }

    .invalid-feedback {
      color: #dc3545;
      font-size: 0.85rem;
      margin-top: -0.5rem;
      margin-bottom: 0.75rem;
    }

    .input-group {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      top: 50%;
      right: 0.75rem;
      transform: translateY(-50%);
      background: none;
      border: none;
      font-size: 1.2rem;
      cursor: pointer;
    }

    @media (max-width: 400px) {
      .login-wrapper {
        padding: 1.5rem;
      }

      h2 {
        font-size: 1.3rem;
      }

      .form-control {
        padding: 0.6rem;
      }
    }
  </style>
</head>

<body>
  <div class="login-wrapper">
    <img src="{{ asset('img/logo.png') }}" alt="Logo TerAmi" class="logo">
    <h2>Iniciar sesión</h2>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email -->
      <div>
        <label for="email" class="form-label">📧 ¿Dónde te escribimos?</label>
        <input id="email" type="email" name="email" placeholder="ejemplo@correo.com"
               class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Password con ojito -->
      <div>
        <label for="password" class="form-label">🔒 Tu clave secreta</label>
        <div class="input-group">
          <input id="password" type="password" name="password" placeholder="••••••••"
                 class="form-control @error('password') is-invalid @enderror" required>
          <button type="button" class="toggle-password" onclick="togglePassword()" tabindex="-1">
            <span id="icon">👁️</span>
          </button>
        </div>
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- JS del ojito -->
      <script>
        function togglePassword() {
          const input = document.getElementById("password");
          const icon = document.getElementById("icon");

          if (input.type === "password") {
            input.type = "text";
            icon.textContent = "🙈";
          } else {
            input.type = "password";
            icon.textContent = "👁️";
          }
        }
      </script>

      <!-- Remember me -->
      <div class="mb-3">
        <label>
          <input type="checkbox" name="remember"> Recordarme
        </label>
      </div>

      <button type="submit" class="btn-login">Entrar</button>

      @if (Route::has('password.request'))
        <div class="text-small">
          <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
        </div>
      @endif

      <div class="text-small mt-3">
        ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
      </div>
    </form>
  </div>
</body>
</html>
