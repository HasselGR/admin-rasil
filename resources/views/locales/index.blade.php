@extends('adminlte::page')

@section('title', 'Listado de Locales de Renta')

@section('content_header')
    <h1>Locales de Renta</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <a href="{{ route('locales.create') }}" class="btn btn-primary mb-3">Agregar Local</a>
    <table class="table table-bordered" id="locales-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Local</th>
                <th>Canon</th>
                <th>Ubicación</th>
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
            $('#locales-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('locales.index') }}',
                columns: [
                    { data: 'id_local', name: 'id_local' },
                    { data: 'nombre_local', name: 'nombre_local' },
                    { data: 'canon', name: 'canon' },
                    { data: 'ubicacion', name: 'ubicacion' },
                    { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@stop