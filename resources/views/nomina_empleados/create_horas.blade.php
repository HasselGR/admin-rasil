@extends('adminlte::page')

@section('title', 'Crear Asignaciones y Deducciones')

@section('content_header')
    <h1>Crear Asignaciones y Deducciones</h1>
@stop

@section('content')
    <form action="{{ route('asignaciones-empleados.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_empleado">Empleado</label>
            <select class="form-control" name="id_empleado" required>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->id_empleado }}">{{ $empleado->nombre_empleado }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex flex-row justify-content-around">
            <div class="w-25">
                    <h2>Asignaciones</h2>
                <div class="form-group">
                    <label for="dias_trabajados">Días Trabajados</label>
                    <input type="number" class="form-control" name="dias_trabajados" required>
                </div>
                <div class="form-group">
                    <label for="dias_descanso">Días Descanso</label>
                    <input type="number" class="form-control" name="dias_descanso" required>
                </div>
                <div class="form-group">
                    <label for="horas_extra_diurnas">Horas Extra Diurnas</label>
                    <input type="number" class="form-control" name="horas_extra_diurnas" required>
                </div>
                <div class="form-group">
                    <label for="horas_extra_nocturnas">Horas Extra Nocturnas</label>
                    <input type="number" class="form-control" name="horas_extra_nocturnas" required>
                </div>
                <div class="form-group">
                    <label for="bono_nocturno">Bono Nocturno</label>
                    <input type="number" class="form-control" name="bono_nocturno" required>
                </div>
                <div class="form-group">
                    <label for="clt">CLT</label>
                    <input type="number" class="form-control" name="clt" required>
                </div>
                <div class="form-group">
                    <label for="dia_feriado_trabajado">Día Feriado Trabajado</label>
                    <input type="number" class="form-control" name="dia_feriado_trabajado" required>
                </div>
                <div class="form-group">
                    <label for="total_devengado">Total Devengado</label>
                    <input type="number" class="form-control" name="total_devengado" required>
                </div>
            </div>


            <div  class="w-25">
                <h2>Deducciones</h2>
                <div class="form-group">
                    <label for="s_s_o">S.S.O</label>
                    <input type="number" class="form-control" name="s_s_o" required>
                </div>
                <div class="form-group">
                    <label for="paro_forzoso">Paro Forzoso</label>
                    <input type="number" class="form-control" name="paro_forzoso" required>
                </div>
                <div class="form-group">
                    <label for="ley_politica_habit">Ley Política Habitacional</label>
                    <input type="number" class="form-control" name="ley_politica_habit" required>
                </div>
                <div class="form-group">
                    <label for="sindicato">Sindicato</label>
                    <input type="number" class="form-control" name="sindicato" required>
                </div>
                <div class="form-group">
                    <label for="descuento_faltas">Descuento Faltas</label>
                    <input type="number" class="form-control" name="descuento_faltas" required>
                </div>
                <div class="form-group">
                    <label for="descuento_prestamos">Descuento Préstamos</label>
                    <input type="number" class="form-control" name="descuento_prestamos" required>
                </div>
                <div class="form-group">
                    <label for="total_deducciones">Total Deducciones</label>
                    <input type="number" class="form-control" name="total_deducciones" required>
                </div>
            </div>


        </div>
        

        

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script> console.log('Page loaded.'); </script>
@stop
