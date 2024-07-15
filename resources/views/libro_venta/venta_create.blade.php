@extends('adminlte::page')

@section('title', 'Crear Libro de Ventas')

@section('content_header')
    <h1>Crear Libro de Ventas</h1>
@stop

@section('content')
    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_quincena">Quincena</label>
            <select class="form-control" name="id_quincena" required>
                @foreach ($quincenas as $quincena)
                    <option value="{{ $quincena->id_quincena }}">{{ $quincena->descripcion }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_factura">Fecha de Factura</label>
            <input type="date" class="form-control" name="fecha_factura" required>
        </div>
        <div class="form-group">
            <label for="nro_rif">Número de RIF</label>
            <input type="text" class="form-control" name="nro_rif" required>
        </div>
        <div class="form-group">
            <label for="prov_razon_social">Razón Social del Proveedor</label>
            <input type="text" class="form-control" name="prov_razon_social" required>
        </div>
        <div class="form-group">
            <label for="nro_factura">Número de Factura</label>
            <input type="number" class="form-control" name="nro_factura" required>
        </div>
        <div class="form-group">
            <label for="nro_control_factura">Número de Control de Factura</label>
            <input type="number" class="form-control" name="nro_control_factura" required>
        </div>
        <div class="form-group">
            <label for="tipo_transaccion">Tipo de Transacción</label>
            <input type="text" class="form-control" name="tipo_transaccion" required>
        </div>
        <div class="form-group">
            <label for="total_ventas">Total Ventas</label>
            <input type="number" step="0.01" class="form-control" name="total_ventas" required>
        </div>
        <div class="form-group">
            <label for="base_impo_contribuyente">Base Imponible Contribuyente</label>
            <input type="number" step="0.01" class="form-control" name="base_impo_contribuyente" required>
        </div>
        <div class="form-group">
            <label for="alicuota_contribuyente">Alicuota Contribuyente</label>
            <input type="number" step="0.01" class="form-control" name="alicuota_contribuyente" required>
        </div>
        <div class="form-group">
            <label for="impuesto_iva_contribuyente">Impuesto IVA Contribuyente</label>
            <input type="number" step="0.01" class="form-control" name="impuesto_iva_contribuyente" required>
        </div>
        <div class="form-group">
            <label for="base_impo_no_contribuyente">Base Imponible No Contribuyente</label>
            <input type="number" step="0.01" class="form-control" name="base_impo_no_contribuyente">
        </div>
        <div class="form-group">
            <label for="alicuota_no_contribuyente">Alicuota No Contribuyente</label>
            <input type="number" step="0.01" class="form-control" name="alicuota_no_contribuyente">
        </div>
        <div class="form-group">
            <label for="impuesto_iva_no_contribuyente">Impuesto IVA No Contribuyente</label>
            <input type="number" step="0.01" class="form-control" name="impuesto_iva_no_contribuyente">
        </div>
        <div class="form-group">
            <label for="iva_retenido">IVA Retenido</label>
            <input type="number" step="0.01" class="form-control" name="iva_retenido">
        </div>
        <div class="form-group">
            <label for="nro_comprobante">Número de Comprobante</label>
            <input type="number" class="form-control" name="nro_comprobante">
        </div>
        <div class="form-group">
            <label for="fecha_comprobante_retencion">Fecha de Comprobante de Retención</label>
            <input type="date" class="form-control" name="fecha_comprobante_retencion">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script> console.log('Page loaded.'); </script>
@stop
