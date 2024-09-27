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
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}">
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
                'copy', 
                'csv', 
                'excel', 
                {
                extend: 'pdf',
                orientation: 'landscape', // Cambiar orientación a horizontal
                pageSize: 'TABLOID',        // Cambiar tamaño de hoja a oficio
                title: 'Libro de Ventas',
                customize: function (doc) {
                    // Reducir el tamaño de la fuente para todo el documento
                    doc.defaultStyle.fontSize = 8; // Tamaño de fuente reducido
                    doc.styles.tableHeader = {
                        fillColor: '#2C3E50', // Color del encabezado
                        color: 'white',
                        alignment: 'center',
                        fontSize: 8 // Tamaño de fuente del encabezado
                    };
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split(''); // Ajustar el ancho de las tablas
                }
                },
                {
                    extend: 'print',
                    text: 'Imprimir', // Cambia el texto del botón a Imprimir
                    autoPrint: true,  // Abre la ventana de impresión automáticamente
                    customize: function (win) {
                        $(win.document.body)
                            .css('font-size', '10pt')  // Cambia el tamaño de la fuente para la impresión
                            .css('margin', '1cm')      // Ajusta el margen de la página
                            .css('width', '100%');     // Usa todo el ancho disponible

                        $(win.document.body).find('table')
                            .addClass('compact')       // Aplica una clase de tabla compacta
                            .css('font-size', 'inherit');  // Asegura que la tabla use la misma fuente que el cuerpo
                    }
                }
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
