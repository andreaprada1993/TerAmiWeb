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
        $evento = Evento::create($request->all());//crear el evento
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

        $evento=Evento::find($id)->delete();//eliminar el evento
        
        return response()->json($evento);// una vez eliminado regrese a evento
    }
}
