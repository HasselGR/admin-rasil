@extends('adminlte::page')

@section('title', 'Crear Cuenta por Cobrar')

@section('content_header')
    <h1>Crear Cuenta por Cobrar</h1>
@stop

@section('content')
    <form action="{{ route('cuentas_por_cobrar.store') }}" method="POST">
        @csrf
        <!-- ID Factura -->
        <div class="form-group">
            <label for="id_factura">ID Factura</label>
            <input type="text" class="form-control" id="id_factura" name="id_factura" required>
        </div>

        <!-- Cliente -->
        <div class="form-group">
            <label for="id_cliente">Cliente</label>
            <select class="form-control" id="id_cliente" name="id_cliente" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre_razon_social }}</option>
                @endforeach
            </select>
        </div>

        <!-- Nombre del Cliente -->
        <div class="form-group">
            <label for="nombre_cliente">Nombre del Cliente</label>
            <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" required readonly>
        </div>

        <!-- Fecha de Emisión -->
        <div class="form-group">
            <label for="fecha_emision">Fecha de Emisión</label>
            <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" required>
        </div>

        <!-- Fecha de Vencimiento -->
        <div class="form-group">
            <label for="fecha_vencimiento">Fecha de Vencimiento</label>
            <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required readonly>
        </div>

        <!-- Monto con IVA -->
        <div class="form-group">
            <label for="monto_con_iva">Monto con IVA</label>
            <input type="number" step="0.01" class="form-control" id="monto_con_iva" name="monto_con_iva" required>
        </div>

        <!-- Estado (Pendiente por defecto) -->
        <input type="hidden" name="estado" value="0"> <!-- Falso por defecto -->

        <!-- Fecha de Pago (nulo inicialmente) -->
        <input type="hidden" name="fecha_pago" value="">

        <!-- Botón para crear la cuenta -->
        <button type="submit" class="btn btn-primary">Crear Cuenta</button>
    </form>
@stop

@section('js')
    <script>
        // Obtener el nombre del cliente al seleccionar el id_cliente
        $('#id_cliente').change(function() {
            var selectedOption = $(this).find('option:selected');
            $('#nombre_cliente').val(selectedOption.text());
        });

        // Calcular automáticamente la fecha de vencimiento (15 días después)
        $('#fecha_emision').change(function() {
            var fechaEmision = new Date($(this).val());
            if (!isNaN(fechaEmision.getTime())) {
                // Sumar 15 días
                fechaEmision.setDate(fechaEmision.getDate() + 16);
                // Formatear la fecha como YYYY-MM-DD
                var dd = String(fechaEmision.getDate()).padStart(2, '0');
                var mm = String(fechaEmision.getMonth() + 1).padStart(2, '0'); // Enero es 0
                var yyyy = fechaEmision.getFullYear();
                var fechaVencimiento = yyyy + '-' + mm + '-' + dd;
                // Asignar la fecha de vencimiento
                $('#fecha_vencimiento').val(fechaVencimiento);
            }
        });
    </script>
@stop
