<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Auth;

// ✅ Página principal sin login
// Ruta raíz principal
Route::get('/', function () {
    return view('welcome');
})->name('inicio');

// Ruta alternativa con /welcome
Route::get('/welcome', function () {
    return view('welcome');
});

// ✅ Rutas de autenticación
Auth::routes();

// ✅ Rutas protegidas por login
Route::middleware(['auth'])->group(function () {

    // Página de inicio después del login
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Vista de eventos y CRUD
    Route::get('/evento', [EventoController::class, 'index'])->name('evento.index');
    Route::post('/evento/mostrar', [EventoController::class, 'show']);
    Route::post('/evento/agregar', [EventoController::class, 'store']);
    Route::post('/evento/editar/{id}', [EventoController::class, 'edit']);
    Route::post('/evento/actualizar/{evento}', [EventoController::class, 'update']);
    Route::post('/evento/borrar/{id}', [EventoController::class, 'destroy']);

    // Seguimiento de tareas
    Route::get('/seguimiento', [HomeController::class, 'seguimiento'])->name('seguimiento');
    Route::post('/evento/{id}/pendiente', [EventoController::class, 'marcarPendiente'])->name('evento.pendiente');
    Route::post('/evento/{id}/realizar', [EventoController::class, 'marcarRealizada'])->name('evento.realizar');
    Route::post('/evento/{id}/sin-hacer', [EventoController::class, 'marcarSinHacer'])->name('evento.sin_hacer');

    // Reporte PDF
    Route::get('/reporte-avance', [ReporteController::class, 'reporteAvance'])->name('reporte.avance');

});
