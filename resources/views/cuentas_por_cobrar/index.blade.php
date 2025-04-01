@extends('adminlte::page')

@section('title', 'Cuentas por Cobrar')

@section('content_header')
    <h1>Cuentas por Cobrar</h1>
@stop

@section('content')
    <a href="{{ route('cuentas_por_cobrar.create') }}" class="btn btn-primary mb-3">Crear Nueva Cuenta</a>
    <div class="form-group">
        <label for="empresa">Selecciona una Empresa para Imprimir</label>
        <select name="id_cliente" id="empresa" class="form-control" required>
            <option value="">Seleccione una empresa</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre_razon_social }}</option>
            @endforeach
        </select>
    </div>

    <a href="#" id="imprimirBtn" class="btn btn-primary" target="_blank" data-url="{{ url('cuentas_por_cobrar/imprimir') }}">Imprimir Informe</a>

    <hr>
    <table class="table table-bordered" id="cuentas-table">
        <thead>
            <tr>
                <th>ID Factura</th>
                <th>Cliente</th>
                <th>Fecha Emisión</th>
                <th>Fecha Vencimiento</th>
                <th>Monto con IVA</th>
                <th>Estado</th>
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
            $('#cuentas-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('cuentas_por_cobrar.index') }}',
                columns: [
                    { data: 'id_factura', name: 'id_factura' },
                    { data: 'nombre_cliente', name: 'nombre_cliente' },
                    { data: 'fecha_emision', name: 'fecha_emision' },
                    { data: 'fecha_vencimiento', name: 'fecha_vencimiento' },
                    { data: 'monto_con_iva', name: 'monto_con_iva' },
                    { data: 'estado', name: 'estado', render: function(data, type, row) {
                        return data ? 'Pagada (Fecha Pago: ' + row.fecha_pago + ')' : 'Pendiente';
                    }},
                    { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
                ]
            });

            $('#empresa').change(function() {
                var id_cliente = $(this).val();
                var url = $('#imprimirBtn').data('url') + '/' + id_cliente;
                $('#imprimirBtn').attr('href', url);
            });
        });
    </script>
@stop