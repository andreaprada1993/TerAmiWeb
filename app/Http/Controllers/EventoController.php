<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

use Carbon\Carbon;


class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('evento.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate(Evento::$rules);//validar los datos de eventos es decir tabla agregar recordatorio

        $evento = new Evento();
        $evento->title = $request->title;
        $evento->descripcion = $request->descripcion;
        $evento->start = $request->start;
        $evento->end = $request->end;
        // 👇 Esta línea es la clave
        $evento->user_id = auth()->id(); // 👈 Esto es lo que asegura que el evento pertenece al usuario actual
        $evento->save();

        return response()->json($evento); // para confirmar que se guardó bien
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        //
        $evento = Evento::all();//acceder directamente a los registros
        return response()->json($evento);//devolviendo el formato
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $evento = Evento::find($id);//buscar el evento por id
        $evento->start = Carbon::createFromFormat('Y-m-d H:i:s', $evento->start)->format('Y-m-d');//convertir el evento a formato de fecha
        $evento->end = Carbon::createFromFormat('Y-m-d H:i:s', $evento->end)->format('Y-m-d');//arregla para que solo se mire año,mes y dia
        return response()->json($evento);//devolviendo el formato
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {
        //
        request()->validate(Evento::$rules);//validar los datos de eventos es decir tabla agregar recordatorio
        $evento->update($request->all());//hacer la actualizacion
        return response()->json($evento);//datos que salen
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $evento = Evento::find($id)->delete();//eliminar el evento

        return response()->json($evento);// una vez eliminado regrese a evento
    }

    /**
     * Marcar una tarea como realizada.
     */
    public function marcarRealizada($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->estado = 'realizada';
        $evento->save();

        return redirect()->back()->with('success', 'Tarea marcada como realizada');
    }

    /**
     * Marcar una tarea como sin hacer.
     */
    public function marcarSinHacer($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->estado = 'sin_hacer';
        $evento->save();

        return redirect()->back()->with('success', 'Tarea marcada como sin hacer');
    }
}
