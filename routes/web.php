<?php

use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('evento.index');
})->middleware("auth");

Auth::routes();

Route::group(['middleware' => ['auth']], function(){

Route::get('/evento', [App\Http\Controllers\EventoController::class, 'index']);//mostrar la vista de evento
Route::post('/evento/mostrar', [App\Http\Controllers\EventoController::class, 'show']);//mostrar la vista de evento
Route::post('/evento/agregar', [App\Http\Controllers\EventoController::class, 'store']);//guardar el evento
Route::post('/evento/editar/{id}', [App\Http\Controllers\EventoController::class, 'edit']);//editar el evento
Route::post('/evento/actualizar/{evento}', [App\Http\Controllers\EventoController::class, 'update']);//actualizar el evento
Route::post('/evento/borrar/{id}', [App\Http\Controllers\EventoController::class, 'destroy']);//eliminar el evento

});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');//mostrar la vista de eventos

