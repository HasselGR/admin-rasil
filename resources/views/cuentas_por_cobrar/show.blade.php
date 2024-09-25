{{-- resources/views/cuentas_por_cobrar/show.blade.php --}}
@extends('adminlte::page')

@section('title', 'Detalle de Cuenta por Cobrar')

@section('content_header')
    <h1>Detalle de Cuenta por Cobrar</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Detalles de la Cuenta por Cobrar</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="id_factura">ID Factura</label>
                <p>{{ $cuentaPorCobrar->id_factura }}</p>
            </div>
            <div class="form-group">
                <label for="nombre_cliente">Nombre del Cliente</label>
                <p>{{ $cuentaPorCobrar->nombre_cliente }}</p>
            </div>
            <div class="form-group">
                <label for="fecha_emision">Fecha de Emisión</label>
                <p>{{ $cuentaPorCobrar->fecha_emision }}</p>
            </div>
            <div class="form-group">
                <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                <p>{{ $cuentaPorCobrar->fecha_vencimiento }}</p>
            </div>
            <div class="form-group">
                <label for="monto_con_iva">Monto con IVA</label>
                <p>{{ number_format($cuentaPorCobrar->monto_con_iva, 2) }}</p>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <p>{{ $cuentaPorCobrar->estado ? 'Pagado' : 'Pendiente' }}</p>
            </div>
            <div class="form-group">
                <label for="fecha_pago">Fecha de Pago</label>
                <p>{{ $cuentaPorCobrar->fecha_pago ?? 'N/A' }}</p>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('cuentas_por_cobrar.index') }}" class="btn btn-primary">Volver a la lista</a>
        </div>
    </div>
@stop

@section('css')
    {{-- Agregar estilos adicionales si es necesario --}}
@stop

@section('js')
    <script> console.log('Página de detalle de cuenta por cobrar cargada'); </script>
@stop
