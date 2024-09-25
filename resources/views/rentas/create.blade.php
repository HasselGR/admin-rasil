@extends('adminlte::page')

@section('title', 'Crear Renta Locales')

@section('content_header')
    <h1>Crear Renta de Local</h1>
@stop

@section('content')
    <form action="{{ route('renta_locales.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="id_cliente">Cliente</label>
            <select class="form-control" id="id_cliente" name="id_cliente" required>
                <option value="">Seleccionar Cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}" data-saldo="{{ $cliente->saldo }}">{{ $cliente->nombre_razon_social }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="id_local">Local</label>
            <select class="form-control" id="id_local" name="id_local" required>
                <option value="">Seleccionar Local</option>
                @foreach ($locales as $local)
                    <option value="{{ $local->id_local }}">{{ $local->ubicacion }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="saldo_cliente">Saldo del Cliente</label>
            <input type="text" class="form-control" id="saldo_cliente" readonly>
        </div>

        <div class="form-group">
            <label for="haber">Monto (Haber)</label>
            <input type="number" step="0.01" class="form-control" id="haber" name="haber" required>
        </div>

        <div class="form-group">
            <label for="saldo_despues">Saldo después de la Transacción</label>
            <input type="text" class="form-control" id="saldo_despues" readonly>
        </div>

        <div class="form-group">
            <label for="concepto">Concepto</label>
            <input type="text" class="form-control" id="concepto" name="concepto" required>
        </div>

        <div class="form-group">
            <label for="forma_pago">Forma de Pago</label>
            <input type="text" class="form-control" id="forma_pago" name="forma_pago" required>
        </div>

        <div class="form-group">
            <label for="retencion_iva">Retención IVA</label>
            <input type="number" step="0.01" class="form-control" id="retencion_iva" name="retencion_iva" value="0" required>
        </div>

        <div class="form-group">
            <label for="retencion_isrf">Retención ISRF</label>
            <input type="number" step="0.01" class="form-control" id="retencion_isrf" name="retencion_isrf" value="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Crear Renta</button>
    </form>
@stop

@section('css')
    {{-- Estilos adicionales --}}
@stop

@section('js')
    <script>
        // Mostrar el saldo del cliente seleccionado
        document.getElementById('id_cliente').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var saldo = selectedOption.getAttribute('data-saldo');
            document.getElementById('saldo_cliente').value = saldo ? saldo : '0.00';
            calcularSaldoDespues();
        });

        // Calcular el saldo después de la transacción cuando se cambia el valor del Haber
        document.getElementById('haber').addEventListener('input', calcularSaldoDespues);

        function calcularSaldoDespues() {
            var saldoCliente = parseFloat(document.getElementById('saldo_cliente').value) || 0;
            var haber = parseFloat(document.getElementById('haber').value) || 0;
            var saldoDespues = saldoCliente - haber;
            document.getElementById('saldo_despues').value = saldoDespues.toFixed(2);
        }
    </script>
@stop
