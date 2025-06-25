<?php

namespace App\Http\Controllers;
use App\Models\Evento;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
       $tareasPendientes = Evento::where('user_id', auth()->id())
                              ->where('start', '>=', now())
                              ->orderBy('start')
                              ->get();

    return view('home', compact('tareasPendientes'));
    }

    public function seguimiento()
{
    $userId = auth()->id();

    $tareasPendientes = Evento::where('user_id', $userId)
        ->where('start', '>=', now())
        ->whereNull('estado') // o lo que uses como estado
        ->get();

    $tareasRealizadas = Evento::where('user_id', $userId)
        ->where('estado', 'realizada')
        ->get();

    $tareasSinHacer = Evento::where('user_id', $userId)
        ->where('start', '<', now())
        ->whereNull('estado') // o usa 'sin_hacer' si tienes ese estado
        ->get();

    return view('seguimiento', compact('tareasPendientes', 'tareasRealizadas', 'tareasSinHacer'));
}
}
