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
            <input type="text" class="form-control" name="cedula_identidad"  pattern="^[VEJ]-(\d{7,9}|\d{1,3}(?:\.\d{3})+)$" value="{{ $nominaEmpleado->cedula_identidad }}" minlength="8" maxlength="15" placeholder="V o E o J - Número de Cédula"
            oninvalid="this.setCustomValidity('Formato inválido. Use V-, E- o J- seguido de números. Ej: V-12345678')" oninput="this.setCustomValidity('')"
            required>
        </div>
        <div class="form-group">
            <label for="cod_contrato">Código de Contrato</label>
            <input type="text" class="form-control" name="cod_contrato" pattern="\d*" placeholder="Número de Contrato" maxlength="8" value="{{ $nominaEmpleado->cod_contrato }}" required>
        </div>
        <div class="form-group">
            <label for="salario_gobierno">Salario Gobierno</label>
            <input type="text" class="form-control" name="salario_gobierno" pattern="\d*" placeholder="Cantidad Numérica en Bs." maxlength="12" value="{{ $nominaEmpleado->salario_gobierno }}" required>
        </div>
        <div class="form-group">
            <label for="salario_empresa">Salario Empresa</label>
            <input type="text" class="form-control" name="salario_empresa"  pattern="\d*" placeholder="Cantidad Numérica en Bs." maxlength="12" value="{{ $nominaEmpleado->salario_empresa }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script src="{{ asset('vendor/blockui/js/jquery.blockui.min.js') }}"></script>
    <script src="{{ asset('js/blockUI.js') }}"></script> <!-- Importa el script generalizado -->
@stop