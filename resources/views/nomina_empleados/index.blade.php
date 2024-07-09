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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('js/index_nomina.js') }}"></script>
@stop
