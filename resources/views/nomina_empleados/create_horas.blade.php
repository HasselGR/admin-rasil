@extends('adminlte::page')

@section('title', 'Crear Asignaciones y Deducciones')

@section('content_header')
    <h1>Crear Asignaciones y Deducciones</h1>
@stop

@section('content')
    <form id="asignaciones-deducciones-form" action="{{ route('asignaciones-empleados.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_empleado">Empleado</label>
            <select class="form-control" name="id_empleado" id="id_empleado" required>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->id_empleado }}"  data-salario="{{ $empleado->salario_empresa }}" >{{ $empleado->nombre_empleado }} </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex flex-row justify-content-around">
            <div class="w-25">
                <h2>Asignaciones</h2>
                <div class="form-group">
                    <label for="dias_trabajados">Días Trabajados</label>
                    <input type="number" class="form-control" name="dias_trabajados"  id="dias_trabajados" required>
                </div>
                <div class="form-group">
                    <label for="dias_descanso">Días Descanso</label>
                    <input type="number" class="form-control" name="dias_descanso"  id="dias_descanso"required>
                </div>
                <div class="form-group">
                    <label for="horas_extra_diurnas">Horas Extra Diurnas</label>
                    <input type="number" class="form-control" name="horas_extra_diurnas"  id="horas_extra_diurnas" required>
                </div>
                <div class="form-group">
                    <label for="horas_extra_nocturnas">Horas Extra Nocturnas</label>
                    <input type="number" class="form-control" name="horas_extra_nocturnas" id="horas_extra_nocturnas"required>
                </div>
                <div class="form-group">
                    <label for="bono_nocturno">Bono Nocturno</label>
                    <input type="number" class="form-control" name="bono_nocturno" id="bono_nocturno" required>
                </div>
                <div class="form-group">
                    <label for="clt">CLT</label>
                    <input type="number" class="form-control" name="clt" id="clt" required>
                </div>
                <div class="form-group">
                    <label for="dia_feriado_trabajado">Día Feriado Trabajado</label>
                    <input type="number" class="form-control" name="dia_feriado_trabajado" id="dia_feriado_trabajado" required>
                </div>
                <div class="form-group">
                    <label for="total_devengado">Total Devengado</label>
                    <input type="number" class="form-control" name="total_devengado" id="total_devengado" required readonly>
                </div>
            </div>

            <div class="w-25">
                <h2>Deducciones</h2>
                <div class="form-group">
                    <label for="s_s_o">S.S.O</label>
                    <input type="number" class="form-control" name="s_s_o" id="s_s_o" required>
                </div>
                <div class="form-group">
                    <label for="paro_forzoso">Paro Forzoso</label>
                    <input type="number" class="form-control" name="paro_forzoso" id="paro_forzoso" required>
                </div>
                <div class="form-group">
                    <label for="ley_politica_habit">Ley Política Habitacional</label>
                    <input type="number" class="form-control" name="ley_politica_habit" id="ley_politica_habit"  required>
                </div>
                <div class="form-group">
                    <label for="sindicato">Sindicato</label>
                    <input type="number" class="form-control" name="sindicato" id="sindicato" required>
                </div>
                <div class="form-group">
                    <label for="descuento_faltas">Descuento Faltas</label>
                    <input type="number" class="form-control" name="descuento_faltas" id="descuento_faltas" required>
                </div>
                <div class="form-group">
                    <label for="descuento_prestamos">Descuento Préstamos</label>
                    <input type="number" class="form-control" name="descuento_prestamos" id="descuento_prestamos" required>
                </div>
                <div class="form-group">
                    <label for="total_deducciones">Total Deducciones</label>
                    <input type="number" class="form-control" name="total_deducciones" id="total_deducciones" required readonly>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
    <div class="w-50">
        <label for="total_pagar">Total A Pagar</label>
        <input type="number" class="form-control" name="total_pagar" id="total_pagar" required readonly>
    </div>

    <!-- Selector de Quincena -->
    <div class="form-group">
        <label for="id_quincena">Quincena</label>
        <select class="form-control" name="id_quincena" id="id_quincena" required>
            <!-- Opciones de quincena se cargarán aquí -->
        </select>
    </div>

    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#quincenaModal">
        Crear Quincena
    </button>

    <!-- Modal -->
    <div class="modal fade" id="quincenaModal" tabindex="-1" role="dialog" aria-labelledby="quincenaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quincenaModalLabel">Crear Quincena</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="quincena-form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_final">Fecha Final</label>
                            <input type="date" class="form-control" name="fecha_final" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script src="{{ asset('js/asignaciones_deducciones.js') }}"></script>
@stop