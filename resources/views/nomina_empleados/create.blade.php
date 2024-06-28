@extends('adminlte::page')

@section('title', 'Agregar Empleado')

@section('content_header')
    <h1>Agregar Empleado</h1>
@stop

@section('content')
    <form action="{{ route('nomina-empleados.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre_empleado">Nombre del Empleado</label>
            <input type="text" class="form-control" name="nombre_empleado" required>
        </div>
        <div class="form-group">
            <label for="cedula_identidad">Cédula de Identidad</label>
            <input type="text" class="form-control" name="cedula_identidad" required>
        </div>
        <div class="form-group">
            <label for="cod_contrato">Código de Contrato</label>
            <input type="text" class="form-control" name="cod_contrato" required>
        </div>
        <div class="form-group">
            <label for="salario_gobierno">Salario Gobierno</label>
            <input type="number" class="form-control" name="salario_gobierno" required>
        </div>
        <div class="form-group">
            <label for="salario_empresa">Salario Empresa</label>
            <input type="number" class="form-control" name="salario_empresa" required>
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