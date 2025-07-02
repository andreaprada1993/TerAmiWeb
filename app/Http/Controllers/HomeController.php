<?php

namespace App\Http\Controllers;
use App\Models\Evento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;




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
        ->where('estado', 'pendiente')       // ✅ Solo tareas pendientes
        ->where('start', '>=', now())        // ✅ Solo tareas futuras
        ->orderBy('start')
        ->get();

    return view('home', compact('tareasPendientes'));
    }



public function seguimiento(Request $request)
{
    $userId = Auth::id();

    // Obtener el mes seleccionado o usar el mes actual
    $mesSeleccionado = $request->input('mes');
    if (!$mesSeleccionado || !preg_match('/^\d{4}-\d{2}$/', $mesSeleccionado)) {
        $mesSeleccionado = now()->format('Y-m');
    }

    try {
        $inicioMes = Carbon::createFromFormat('Y-m', $mesSeleccionado)->startOfMonth();
        $finMes = Carbon::createFromFormat('Y-m', $mesSeleccionado)->endOfMonth();
    } catch (\Exception $e) {
        $inicioMes = now()->startOfMonth();
        $finMes = now()->endOfMonth();
    }

    // Base filtrada por usuario y mes
    $eventosDelMes = Evento::where('user_id', $userId)
        ->whereBetween('start', [$inicioMes, $finMes])
        ->get();

    // Agrupación por estado
    $tareasPendientes = $eventosDelMes->where('estado', 'pendiente');
    $tareasRealizadas = $eventosDelMes->where('estado', 'realizada');
    $tareasSinHacer   = $eventosDelMes->where('estado', 'sin_hacer');

    return view('seguimiento', compact(
        'tareasPendientes',
        'tareasRealizadas',
        'tareasSinHacer',
        'mesSeleccionado'
    ));
}

}
