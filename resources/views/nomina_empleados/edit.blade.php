@extends('adminlte::page')

@section('title', 'Editar Empleado')

@section('content_header')
    <h1>Editar Empleado</h1>
@stop

@section('content')
    <form action="{{ route('nomina-empleados.update', $nominaEmpleado->id_empleado) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre_empleado">Nombre del Empleado</label>
            <input type="text" class="form-control" name="nombre_empleado" value="{{ $nominaEmpleado->nombre_empleado }}" required>
        </div>
        <div class="form-group">
            <label for="cedula_identidad">Cédula de Identidad</label>
            <input type="text" class="form-control" name="cedula_identidad" value="{{ $nominaEmpleado->cedula_identidad }}" required>
        </div>
        <div class="form-group">
            <label for="cod_contrato">Código de Contrato</label>
            <input type="text" class="form-control" name="cod_contrato" value="{{ $nominaEmpleado->cod_contrato }}" required>
        </div>
        <div class="form-group">
            <label for="salario_gobierno">Salario Gobierno</label>
            <input type="number" class="form-control" name="salario_gobierno" value="{{ $nominaEmpleado->salario_gobierno }}" required>
        </div>
        <div class="form-group">
            <label for="salario_empresa">Salario Empresa</label>
            <input type="number" class="form-control" name="salario_empresa" value="{{ $nominaEmpleado->salario_empresa }}" required>
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