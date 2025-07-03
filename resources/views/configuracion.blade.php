@extends('layouts.app')

@section('content')

    <div class="mt-3 ms-2">
        <a href="{{ route('home') }}" class="btn btn-light" style="font-size: 1.4rem;">
            ←
        </a>
    </div>

    <div class="container mt-5">
        <h2 class="mb-4">⚙️ Configuración del perfil</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('configuracion.update') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Número de celular</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $user->telefono) }}"
                    required>
                @error('telefono')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
    <div>
       @if(auth()->user()->rol !== 'admin')
    <form action="{{ route('perfil.eliminar') }}" method="POST"
        onsubmit="return confirm('😢 ¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            🗑️ Eliminar cuenta
        </button>
    </form>
@endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection