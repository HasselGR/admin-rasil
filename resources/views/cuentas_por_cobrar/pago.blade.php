@extends('adminlte::page')

@section('title', 'Registrar Pago de Cuenta por Cobrar')

@section('content_header')
    <h1>Registrar Pago</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Registrar Pago para la Cuenta</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('cuentas_por_cobrar.registrarPago', $cuentaPorCobrar->id_cuenta) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="id_factura">ID Factura</label>
                    <input type="text" class="form-control" value="{{ $cuentaPorCobrar->id_factura }}" readonly>
                </div>

                <div class="form-group">
                    <label for="nombre_cliente">Cliente</label>
                    <input type="text" class="form-control" value="{{ $cuentaPorCobrar->nombre_cliente }}" readonly>
                </div>

                <div class="form-group">
                    <label for="monto_con_iva">Monto con IVA</label>
                    <input type="text" class="form-control" value="{{ $cuentaPorCobrar->monto_con_iva }}" readonly>
                </div>

                <div class="form-group">
                    <label for="fecha_pago">Fecha de Pago</label>
                    <input type="date" name="fecha_pago" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Registrar Pago</button>
                <a href="{{ route('cuentas_por_cobrar.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop

@section('css')
    {{-- Aquí puedes agregar estilos personalizados si es necesario --}}
@stop

@section('js')
    <script src="{{ asset('vendor/blockui/js/jquery.blockui.min.js') }}"></script>
    <script src="{{ asset('js/blockUI.js') }}"></script> <!-- Importa el script generalizado -->
@stop
