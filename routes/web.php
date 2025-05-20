<?php

use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/evento', [App\Http\Controllers\EventoController::class, 'index']);//mostrar la vista de eventos
Route::post('/evento/agregar', [App\Http\Controllers\EventoController::class, 'store']);//guardar el evento

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');//mostrar la vista de eventos

