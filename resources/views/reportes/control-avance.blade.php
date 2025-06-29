
<!DOCTYPE html>
<html lang="es">
    

<head>
    <meta charset="UTF-8">
    <title>Reporte de Avance - Tareami</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            padding: 25px;
            color: #2c3e50;
        }

        h1,
        h2,
        h3 {
            text-align: center;
            color: #34495e;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .mensaje {
            background-color: #f0f8ff;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 5px solid #6c5ce7;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0 20px;
        }

        th {
            background-color: #dfe6e9;
            color: #2d3436;
        }

        th,
        td {
            border: 1px solid #b2bec3;
            padding: 8px;
            text-align: left;
        }

        .footer {
            text-align: center;
            font-style: italic;
            margin-top: 30px;
            color: #636e72;
        }

        .seccion {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="logo">
        <img src="{{ public_path('img/logo.png') }}" width="120" alt="Tareami Logo">
        <h1>Reporte de Avance de Tareas</h1>
        @if($realizadas > ($pendientes + $sinHacer))
            <p><strong>[✓]</strong> ¡Excelente trabajo! Has realizado la mayoría de tus tareas. ¡Sigue así!</p>
        @elseif($pendientes > 0)
            <p><strong>[... ]</strong> Aún tienes tareas pendientes. ¡Tú puedes con todo!</p>
        @else
            <p><strong>[✔]</strong> ¡Todo al día! ¡Eres una máquina de productividad!</p>
        @endif
    </div>

    <h2>Usuario: {{ auth()->user()->name }}</h2>

    <div class="mensaje">
        <p><strong>&#10003; {{ $realizadas }} tareas completadas:</strong> ¡Muy bien, sigue así!</p>
        <p><strong>&#8987; {{ $pendientes }} tareas pendientes:</strong> ¡Aún estás a tiempo para terminarlas!</p>
        <p><strong>&#10007; {{ $sinHacer }} sin realizar:</strong> No pasa nada, mañana es otra oportunidad.</p>
    </div>

    <h3>Resumen General</h3>
    <table>
        <tr>
            <th>Total</th>
            <th>Realizadas</th>
            <th>Pendientes</th>
            <th>Sin Hacer</th>
            <th>Avance (%)</th>
        </tr>
        <tr>
            <td>{{ $realizadas + $pendientes + $sinHacer }}</td>
            <td>{{ $realizadas }}</td>
            <td>{{ $pendientes }}</td>
            <td>{{ $sinHacer }}</td>
            <td>{{ $porcentaje }}%</td>
        </tr>
    </table>

    <div class="seccion">
        <h3>Tareas Realizadas</h3>
        <table>
            <tr>
                <th>Título</th>
                <th>Fecha</th>
            </tr>
            @forelse($tareasRealizadas as $tarea)
                <tr>
                    <td>{{ $tarea->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($tarea->start)->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No hay tareas realizadas.</td>
                </tr>
            @endforelse
        </table>
    </div>

    <div class="seccion">
        <h3>Tareas Pendientes</h3>
        <table>
            <tr>
                <th>Título</th>
                <th>Fecha</th>
            </tr>
            @forelse($tareasPendientes as $tarea)
                <tr>
                    <td>{{ $tarea->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($tarea->start)->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No hay tareas pendientes.</td>
                </tr>
            @endforelse
        </table>
    </div>

    <div class="seccion">
        <h3>Tareas Sin Hacer</h3>
        <table>
            <tr>
                <th>Título</th>
                <th>Fecha</th>
            </tr>
            @forelse($tareasSinHacer as $tarea)
                <tr>
                    <td>{{ $tarea->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($tarea->start)->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Todo al día.</td>
                </tr>
            @endforelse
        </table>
    </div>

    <div class="footer">
        Gracias por usar <strong>Tareami</strong>. ¡Sigue construyendo tu mejor versión día a día!
    </div>
</body>

</html>