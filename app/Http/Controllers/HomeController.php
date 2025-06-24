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
}
