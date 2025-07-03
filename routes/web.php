<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

// ✅ Página principal sin login
// Ruta raíz principal
Route::get('/', function () {
    return view('welcome');
})->name('inicio');
// Ruta primer registro
Route::get('/felicidades', function () {
    return view('felicidades');
})->name('felicidades')->middleware('auth');

// Ruta para la vista de eliminar cuentas (puedes cambiar la lógica a un controlador luego)

Route::get('/admin/configuracion', function () {
    return view('admin.configuracion'); // Otra vista para ajustes del sistema
})->name('admin.configuracion');



// Ruta alternativa con /welcome
Route::get('/welcome', function () {
    return view('welcome');
})->middleware('auth');
// ✅ Rutas de autenticación

// Ruta alternativa con /configuracion
Route::get('/configuracion', function () {
    return view('configuracion');

})->name('configuracion');


Auth::routes(['verify' => true]);
// ✅ Rutas protegidas por login
Route::middleware(['auth', 'verified'])->group(function () {

    // Página de inicio después del login
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Funciones de administrador
    Route::get('/admin/usuarios', [UserController::class, 'verUsuarios'])->name('admin.usuarios');
    Route::get('/admin/recuperar', [UserController::class, 'verEliminados'])->name('admin.recuperar');
    Route::patch('/admin/recuperar/{id}', [UserController::class, 'restaurar'])->name('admin.restaurar');
    Route::get('/admin/configuracion', function () {
        return view('admin.configuracion');
    })->name('admin.configuracion');
    Route::get('/admin/tareas', [UserController::class, 'tareasCreadas'])->name('admin.tareas');


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
    // ruta configuracion 
    Route::get('/configuracion', [App\Http\Controllers\UserController::class, 'edit'])->name('configuracion');
    Route::post('/configuracion', [App\Http\Controllers\UserController::class, 'update'])->name('configuracion.update');
    Route::delete('/perfil/eliminar', [App\Http\Controllers\UserController::class, 'eliminarCuenta'])->name('perfil.eliminar');



});
