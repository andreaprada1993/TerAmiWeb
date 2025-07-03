<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Evento;

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

    public function verUsuarios()
    {
        $usuarios = User::all();
        return view('admin.usuarios', compact('usuarios'));
    }

    public function verEliminados()
    {
        $usuariosEliminados = User::onlyTrashed()->get();
        return view('admin.recuperar', compact('usuariosEliminados'));
    }

    public function restaurar($id)
    {
        $usuario = User::onlyTrashed()->findOrFail($id);
        $usuario->restore();

        return redirect()->route('admin.recuperar')->with('success', 'Usuario restaurado correctamente.');
    }
    public function tareasCreadas()
    {
        // Cargar todas las tareas con su usuario asociado, ordenadas por fecha de inicio
        $tareasConUsuarios = Evento::with('user')->orderBy('start')->get();

        return view('admin.tareas', compact('tareasConUsuarios'));
    }

}
