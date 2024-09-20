@extends('adminlte::page')

@section('title', 'Libro de Ventas')

@section('content_header')
    <h1>Libro de Ventas</h1>
@stop

@section('content')
    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Agregar Registro de Libro de Ventas</a>
    <div class="mb-3">
        <label for="quincena-select">Seleccionar Quincena:</label>
        <select id="quincena-select" class="form-control" style="width: 300px;">
            <option value="">Seleccione una Quincena</option>
            @foreach ($quincenas as $quincena)
                <option value="{{ $quincena->id_quincena }}">{{ $quincena->descripcion }}</option>
            @endforeach
        </select>
    </div>

    <button id="generar-pdf" class="btn btn-success mb-3">Generar Resumen PDF</button>
    <table class="table table-bordered" id="ventas-table">
        <thead>
            <tr>
                <th>Fecha de Factura</th>
                <th>Número de RIF</th>
                <th>Razón Social del Proveedor</th>
                <th>Número de Factura</th>
                <th>Número de Control de Factura</th>
                <th>Tipo de Transacción</th>
                <th>Total Ventas</th>
                <th>Base Imponible Contribuyente</th>
                <th>Alicuota Contribuyente</th>
                <th>Impuesto IVA Contribuyente</th>
                <th>Base Imponible No Contribuyente</th>
                <th>Alicuota No Contribuyente</th>
                <th>Impuesto IVA No Contribuyente</th>
                <th>IVA Retenido</th>
                <th>Número de Comprobante</th>
                <th>Fecha Comprobante Retención</th>
            </tr>
        </thead>
    </table>
@stop

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
@stop

@section('js')
    <script src="//code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
            $('#ventas-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('ventas.data') !!}',
                columns: [
                    { data: 'fecha_factura', name: 'fecha_factura' },
                    { data: 'nro_rif', name: 'nro_rif' },
                    { data: 'prov_razon_social', name: 'prov_razon_social' },
                    { data: 'nro_factura', name: 'nro_factura' },
                    { data: 'nro_control_factura', name: 'nro_control_factura' },
                    { data: 'tipo_transaccion', name: 'tipo_transaccion' },
                    { data: 'total_ventas', name: 'total_ventas' },
                    { data: 'base_impo_contribuyente', name: 'base_impo_contribuyente' },
                    { data: 'alicuota_contribuyente', name: 'alicuota_contribuyente' },
                    { data: 'impuesto_iva_contribuyente', name: 'impuesto_iva_contribuyente' },
                    { data: 'base_impo_no_contribuyente', name: 'base_impo_no_contribuyente' },
                    { data: 'alicuota_no_contribuyente', name: 'alicuota_no_contribuyente' },
                    { data: 'impuesto_iva_no_contribuyente', name: 'impuesto_iva_no_contribuyente' },
                    { data: 'iva_retenido', name: 'iva_retenido' },
                    { data: 'nro_comprobante', name: 'nro_comprobante' },
                    { data: 'fecha_comprobante_retencion', name: 'fecha_comprobante_retencion' },
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
        $('#generar-pdf').click(function() {
                var quincenaId = $('#quincena-select').val();
                if (quincenaId) {
                    window.location.href = `/ventas/${quincenaId}/resumen-pdf`;
                } else {
                    alert('Por favor seleccione una quincena para generar el PDF.');
                }
            });
    </script>
@stop
