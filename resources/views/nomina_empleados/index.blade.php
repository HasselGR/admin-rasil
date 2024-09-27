@extends('adminlte::page')

@section('title', 'Nómina de Empleados')

@section('content_header')
    <h1>Nómina de Empleados</h1>
@stop

@section('content')
    <a href="{{ route('nomina-empleados.create') }}" class="btn btn-primary mb-3">Agregar Empleado</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered w-100" id="empleados-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cédula</th>
                <th>Código de Contrato</th>
                <th>Salario Gobierno</th>
                <th>Salario Empresa</th>
                <th width="280px">Acciones</th>
            </tr>
        </thead>
    </table>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}">
@stop

@section('js') 
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/jszip.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/index_nomina.js') }}"></script>
@stop
