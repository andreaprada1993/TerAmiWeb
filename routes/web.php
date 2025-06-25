<?php

use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;





Route::get('/', function () {
    return view('home');
})->middleware("auth");

Auth::routes();

Route::group(['middleware' => ['auth']], function(){

Route::get('/evento', [App\Http\Controllers\EventoController::class, 'index'])->name('evento.index');//mostrar la vista de evento
Route::post('/evento/mostrar', [App\Http\Controllers\EventoController::class, 'show']);//mostrar la vista de evento
Route::post('/evento/agregar', [App\Http\Controllers\EventoController::class, 'store']);//guardar el evento
Route::post('/evento/editar/{id}', [App\Http\Controllers\EventoController::class, 'edit']);//editar el evento
Route::post('/evento/actualizar/{evento}', [App\Http\Controllers\EventoController::class, 'update']);//actualizar el evento
Route::post('/evento/borrar/{id}', [App\Http\Controllers\EventoController::class, 'destroy']);//eliminar el evento
// Ruta para la vista de eventos
Route::get('/', [HomeController::class, 'index'])->middleware('auth');
// Ruta para la vista de inicio
Route::get('/home', [HomeController::class, 'index'])->name('home');
// Ruta para el seguimiento de tareas
Route::get('/seguimiento', [App\Http\Controllers\HomeController::class, 'seguimiento'])->name('seguimiento');

Route::post('/evento/{id}/realizar', [EventoController::class, 'marcarRealizada'])->name('evento.realizar');
Route::post('/evento/{id}/sin-hacer', [EventoController::class, 'marcarSinHacer'])->name('evento.sin_hacer');
});







