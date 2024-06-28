@extends('adminlte::page')

@section('title', 'Detalles del Empleado')

@section('content_header')
    <h1>Detalles del Empleado</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $nominaEmpleado->nombre_empleado }}</h5>
            <p class="card-text"><strong>Cédula:</strong> {{ $nominaEmpleado->cedula_identidad }}</p>
            <p class="card-text"><strong>Código de Contrato:</strong> {{ $nominaEmpleado->cod_contrato }}</p>
            <p class="card-text"><strong>Salario Gobierno:</strong> {{ $nominaEmpleado->salario_gobierno }}</p>
            <p class="card-text"><strong>Salario Empresa:</strong> {{ $nominaEmpleado->salario_empresa }}</p>
            <a href="{{ route('nomina-empleados.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script> console.log('Page loaded.'); </script>
@stop