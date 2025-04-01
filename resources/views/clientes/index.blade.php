{{-- resources/views/clientes/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Lista de Clientes')

@section('content_header')
    <h1>Lista de Clientes</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <a href="{{ route('clientes_renta.create') }}" class="btn btn-primary mb-3">Crear Nuevo Cliente</a>

    <table class="table table-bordered w-75" id="clientes-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre/Razón Social</th>
                <th>RIF</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Saldo</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $('#clientes-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('clientes_renta.index') }}',
                columns: [
                    { data: 'id_cliente', name: 'id_cliente' },
                    { data: 'nombre_razon_social', name: 'nombre_razon_social' },
                    { data: 'rif', name: 'rif' },
                    { data: 'telefono', name: 'telefono' },
                    { data: 'correo', name: 'correo' },
                    { data: 'saldo', name: 'saldo' },
                    { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@stop
