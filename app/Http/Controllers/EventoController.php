<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $eventos = Evento::where('user_id', Auth::id())->get();
        return view('evento.index', compact('eventos'));
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
        request()->validate(Evento::$rules);

        $evento = new Evento();
        $evento->title = $request->title;
        $evento->descripcion = $request->descripcion;
        $evento->start = $request->start;
        $evento->end = $request->end;
        $evento->estado = 'pendiente'; // 👈 obligatorio
        $evento->user_id = auth()->id();
        $evento->save();

        return response()->json($evento);
    }
    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        //
        $eventos = Evento::where('user_id', Auth::id())->get();
        return response()->json($eventos);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $evento = Evento::find($id);//buscar el evento por id
        $evento->start = Carbon::createFromFormat('Y-m-d H:i:s', $evento->start)->format('Y-m-d\TH:i');
        $evento->end = Carbon::createFromFormat('Y-m-d H:i:s', $evento->end)->format('Y-m-d\TH:i');

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
     * Marcar una tarea como pendiente
     */

    public function marcarRealizada(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);
        $evento->estado = 'realizada';
        $evento->save();

        return redirect()->route('seguimiento', ['mes' => $request->input('mes')]);
    }

    public function marcarPendiente(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);
        $evento->estado = 'pendiente';

        if ($evento->start < now()) {
            $evento->start = now()->addMinutes(5);
        }

        $evento->save();

        return redirect()->route('seguimiento', ['mes' => $request->input('mes')]);
    }

    public function marcarSinHacer(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);
        $evento->estado = 'sin_hacer';
        $evento->save();

        return redirect()->route('seguimiento', ['mes' => $request->input('mes')]);
    }


}
