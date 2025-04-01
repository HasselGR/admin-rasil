@extends('adminlte::page')

@section('title', 'Asignaciones y Deducciones')

@section('content_header')
    <h1>Asignaciones y Deducciones de {{ $empleado->nombre_empleado }}</h1>
@stop

@section('content')
    <h2>Asignaciones</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Quincena</th>
                <th>Días Trabajados</th>
                <th>Días Descanso</th>
                <th>Horas Extra Diurnas</th>
                <th>Horas Extra Nocturnas</th>
                <th>Bono Nocturno</th>
                <th>CLT</th>
                <th>Día Feriado Trabajado</th>
                <th>Total Devengado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asignaciones as $asignacion)
            <tr class="bg-white">
                <td>{{ $asignacion->quincena->descripcion }}   ( {{ $asignacion->quincena->fecha_inicio }} - {{ $asignacion->quincena->fecha_final }} )</td>
                <td>{{ $asignacion->dias_trabajados }}</td>
                <td>{{ $asignacion->dias_descanso }}</td>
                <td>{{ $asignacion->horas_extra_diurnas }}</td>
                <td>{{ $asignacion->horas_extra_nocturnas }}</td>
                <td>{{ $asignacion->bono_nocturno }}</td>
                <td>{{ $asignacion->clt }}</td>
                <td>{{ $asignacion->dia_feriado_trabajado }}</td>
                <td>{{ $asignacion->total_devengado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Deducciones</h2>
    <table class="table table-bordered">
        <thead>
            <tr >
                <th>Quincena</th>
                <th>S.S.O</th>
                <th>Paro Forzoso</th>
                <th>Ley Política Habitacional</th>
                <th>Sindicato</th>
                <th>Descuento Faltas</th>
                <th>Descuento Préstamos</th>
                <th>Total Deducciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deducciones as $deduccion)
            <tr class="bg-white">
                <td>{{ $deduccion->quincena->descripcion }} ( {{ $deduccion->quincena->fecha_inicio }} - {{ $deduccion->quincena->fecha_final }} )</td>
                <td>{{ $deduccion->s_s_o }}</td>
                <td>{{ $deduccion->paro_forzoso }}</td>
                <td>{{ $deduccion->ley_politica_habit }}</td>
                <td>{{ $deduccion->sindicato }}</td>
                <td>{{ $deduccion->descuento_faltas }}</td>
                <td>{{ $deduccion->descuento_prestamos }}</td>
                <td>{{ $deduccion->total_deducciones }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script> console.log('Page loaded.'); </script>
@stop
