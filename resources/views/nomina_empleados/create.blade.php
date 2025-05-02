@extends('adminlte::page')

@section('title', 'Agregar Empleado')

@section('content_header')
    <h1>Agregar Empleado</h1>
@stop

@section('content')
    
    <form class="card w-25 p-2" action="{{ route('nomina-empleados.store') }}" method="POST">
        <h5>Por favor, introduzca los datos del empleado a agregar.</h5>
        @csrf
        <div class="form-group">
            <label for="nombre_empleado">Nombre del Empleado</label>
            <input type="text" class="form-control" name="nombre_empleado" required>
        </div>
        <div class="form-group">
            <label for="cedula_identidad">Cédula de Identidad</label>
            <input type="text" class="form-control" name="cedula_identidad" pattern="^[VEJ]-(\d{7,9}|\d{1,3}(?:\.\d{3})+)$" placeholder="V o E o J - Número de Cédula"  minlength="8" maxlength="12"
            oninvalid="this.setCustomValidity('Formato inválido. Use V-, E- o J- seguido de números. Ej: V-12345678')" oninput="this.setCustomValidity('')"
            required>
        </div>
        <div class="form-group">
            <label for="cod_contrato">Código de Contrato</label>
            <input type="text" class="form-control" pattern="\d*" placeholder="Número de Contrato" name="cod_contrato" minlength="1" maxlength="8" required>
        </div>
        <div class="form-group">
            <label for="salario_gobierno">Salario Gobierno</label>
            <input type="text" min="0" class="form-control" name="salario_gobierno" pattern="\d*" placeholder="Cantidad Numérica en Bs."  maxlength="12" required>
        </div>
        <div class="form-group">
            <label for="salario_empresa">Salario Empresa</label>
            <input type="text" min="0"  class="form-control" name="salario_empresa" pattern="\d*" placeholder="Cantidad Numérica en Bs." maxlength="12" required>
        </div>
        <button type="submit" class="w-25 btn btn-primary ml-auto">Guardar</button>
    </form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script src="{{ asset('vendor/blockui/js/jquery.blockui.min.js') }}"></script>
    <script src="{{ asset('js/blockUI.js') }}"></script> <!-- Importa el script generalizado -->
@stop