@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold" style="color: #2C3E50;">
        ¡Bienvenido, <span class="text-primary">{{ auth()->user()->name }}</span>! 🎉
    </h2>

    <div class="row g-4">

        {{-- 🔵 Usuarios registrados --}}
        <div class="col-md-4">
            <a href="{{ route('admin.usuarios') }}" class="text-decoration-none">
                <div class="card text-white bg-primary shadow-sm h-100 border-0 rounded-4 hover-shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x mb-3"></i>
                        <h5 class="card-title fw-semibold">Usuarios registrados</h5>
                        <p class="display-6 fw-bold">{{ $totalUsuarios }}</p>
                        <p class="text-white">Ver lista</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- 🟢 Tareas creadas --}}
        <div class="col-md-4">
            <a href="{{ route('admin.tareas') }}" class="text-decoration-none">
                <div class="card text-white bg-success shadow-sm h-100 border-0 rounded-4 hover-shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-tasks fa-2x mb-3"></i>
                        <h5 class="card-title fw-semibold">Tareas creadas</h5>
                        <p class="display-6 fw-bold">{{ $totalTareas }}</p>
                        <p class="text-white">Ver tareas</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- 🔴 Recuperar usuarios --}}
        <div class="col-md-4">
            <a href="{{ route('admin.recuperar') }}" class="text-decoration-none">
                <div class="card text-white bg-danger shadow-sm h-100 border-0 rounded-4 hover-shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-user-restore fa-2x mb-3"></i>
                        <h5 class="card-title fw-semibold">Recuperar usuarios</h5>
                        <p class="display-6 fw-bold">{{ $usuariosEliminados->count() }}</p>
                        <p class="text-white">Cuentas eliminadas</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>

{{-- Estilo para efecto hover --}}
<style>
    .hover-shadow:hover {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        transform: translateY(-3px);
        transition: all 0.3s ease;
    }
</style>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>