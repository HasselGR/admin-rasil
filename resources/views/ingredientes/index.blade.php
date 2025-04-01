@extends('adminlte::page')

@section('title', 'Listado de Ingredientes')

@section('content_header')
    <h1>Ingredientes</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <a href="{{ route('ingredientes.create') }}" class="btn btn-primary mb-3">Agregar Ingrediente</a>
    <table class="table table-bordered w-75" id="ingredientes-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Ingrediente</th>
                <th>Cantidad</th>
                <th>Unidad de Medida</th>
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
            $('#ingredientes-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('ingredientes.index') }}',
                columns: [
                    { data: 'id_ingrediente', name: 'id_ingrediente' },
                    { data: 'nombre_ingrediente', name: 'nombre_ingrediente' },
                    { data: 'cantidad', name: 'cantidad', render: function(data, type, row) {
                        return data < 0 ? '<span class="text-danger font-weight-bold">' + data + '</span>' : data;
                    }},
                    { data: 'unidad_medida', name: 'unidad_medida', defaultContent: 'N/A' },
                    { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@stop
