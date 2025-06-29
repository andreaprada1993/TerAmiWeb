<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Evento;


class ReporteController extends Controller
{
    public function reporteAvance()
    {
        $userId = auth()->id();

        $todas = Evento::where('user_id', $userId)->count();
        $realizadas = Evento::where('user_id', $userId)->where('estado', 'realizada')->count();
        $sinHacer = Evento::where('user_id', $userId)->whereNull('estado')->where('start', '<', now())->count();
        $pendientes = Evento::where('user_id', $userId)->whereNull('estado')->where('start', '>=', now())->count();

        $porcentaje = $todas > 0 ? round(($realizadas / $todas) * 100, 2) : 0;

        $tareasRealizadas = Evento::where('user_id', $userId)->where('estado', 'realizada')->get();
        $tareasPendientes = Evento::where('user_id', $userId)->whereNull('estado')->where('start', '>=', now())->get();
        $tareasSinHacer = Evento::where('user_id', $userId)->whereNull('estado')->where('start', '<', now())->get();

        $pdf = Pdf::loadView('reportes.control-avance', compact(
            'realizadas',
            'pendientes',
            'sinHacer',
            'porcentaje',
            'tareasRealizadas',
            'tareasPendientes',
            'tareasSinHacer'
        ));

        return $pdf->download('control_avance.pdf');
    }

}
