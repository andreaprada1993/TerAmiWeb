<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
{
    return view('configuracion', ['user' => auth()->user()]);
}

public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|regex:/^[\pL\s]+$/u',
        'email' => 'required|email|unique:users,email,' . auth()->id(),
        'telefono' => 'required|numeric|digits_between:7,15',
    ]);

    $user = auth()->user();
    $user->update($request->only('name', 'email', 'telefono'));

    return redirect()->route('configuracion')->with('success', 'Datos actualizados correctamente');
}

public function eliminarCuenta(Request $request)
{
    $user = $request->user();
    Auth::logout();

    $user->delete();

    return redirect('/')->with('status', 'Tu cuenta ha sido eliminada exitosamente.');
}

}
