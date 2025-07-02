<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReporteController extends Controller
{
    public function reporteAvance(Request $request)
    {
        $userId = Auth::id();

        // Validar y obtener mes (YYYY-MM)
        $mes = $request->input('mes');
        if (!$mes || !preg_match('/^\d{4}-\d{2}$/', $mes)) {
            $mes = now()->format('Y-m');
        }

        // Crear fechas inicio y fin de mes
        $inicioMes = Carbon::createFromFormat('Y-m', $mes)->startOfMonth();
        $finMes = Carbon::createFromFormat('Y-m', $mes)->endOfMonth();

        // Query base para ese usuario y mes
        $query = Evento::where('user_id', $userId)
            ->whereBetween('start', [$inicioMes, $finMes]);

        // Obtener tareas según estado
        $tareasRealizadas = (clone $query)->where('estado', 'realizada')->get();
        $tareasPendientes = (clone $query)->where('estado', 'pendiente')->get();
        $tareasSinHacer = (clone $query)->where('estado', 'sin_hacer')->get();

        // Contar tareas para resumen
        $realizadas = $tareasRealizadas->count();
        $pendientes = $tareasPendientes->count();
        $sinHacer = $tareasSinHacer->count();
        $total = $realizadas + $pendientes + $sinHacer;
        $porcentaje = $total > 0 ? round(($realizadas / $total) * 100, 2) : 0;

        // Generar PDF con la vista y descargarlo
        return Pdf::loadView('reportes.control-avance', compact(
            'realizadas',
            'pendientes',
            'sinHacer',
            'porcentaje',
            'tareasRealizadas',
            'tareasPendientes',
            'tareasSinHacer'
        ))->download("control_avance_{$mes}.pdf");
    }
}