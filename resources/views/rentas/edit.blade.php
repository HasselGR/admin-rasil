{{-- resources/views/rentas/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Editar Renta de Local')

@section('content_header')
    <h1>Editar Renta de Local</h1>
@stop

@section('content')
    <form action="{{ route('renta_locales.update', $renta->id_renta) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_local">Local</label>
            <select class="form-control" id="id_local" name="id_local" required>
                <option value="">Seleccione una opción</option>
                @foreach($locales as $local)
                    <option value="{{ $local->id_local }}" {{ $renta->id_local == $local->id_local ? 'selected' : '' }}>
                        {{ $local->ubicacion }} - Canon: {{ $local->canon }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_cliente">Cliente</label>
            <select class="form-control" id="id_cliente" name="id_cliente" required>
                <option value="">Seleccione una opción</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}" {{ $renta->id_cliente == $cliente->id_cliente ? 'selected' : '' }}>
                        {{ $cliente->nombre_razon_social }} - RIF: {{ $cliente->rif }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $renta->fecha }}" required>
        </div>
        <div class="form-group">
            <label for="concepto">Concepto</label>
            <input type="text" class="form-control" id="concepto" name="concepto" value="{{ $renta->concepto }}" required>
        </div>
        <div class="form-group">
            <label for="forma_pago">Forma de Pago</label>
            <input type="text" class="form-control" id="forma_pago" name="forma_pago" value="{{ $renta->forma_pago }}" required>
        </div>
        <div class="form-group">
            <label for="debe">Debe</label>
            <input type="number" step="0.01" class="form-control" id="debe" name="debe" value="{{ $renta->debe }}" required>
        </div>
        <div class="form-group">
            <label for="haber">Haber</label>
            <input type="number" step="0.01" class="form-control" id="haber" name="haber" value="{{ $renta->haber }}" required>
        </div>
        <div class="form-group">
            <label for="retencion_iva">Retención IVA</label>
            <input type="number" step="0.01" class="form-control" id="retencion_iva" name="retencion_iva" value="{{ $renta->retencion_iva }}" required>
        </div>
        <div class="form-group">
            <label for="retencion_isrf">Retención ISRF</label>
            <input type="number" step="0.01" class="form-control" id="retencion_isrf" name="retencion_isrf" value="{{ $renta->retencion_isrf }}" required>
        </div>
        <div class="form-group">
            <label for="saldo">Saldo</label>
            <input type="number" step="0.01" class="form-control" id="saldo" name="saldo" value="{{ $renta->saldo }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Renta</button>
    </form>
@stop

@section('css')
    {{-- Aquí puedes agregar tus estilos personalizados si es necesario --}}
@stop

@section('js')
    <script src="{{ asset('vendor/blockui/js/jquery.blockui.min.js') }}"></script>
    <script src="{{ asset('js/blockUI.js') }}"></script> <!-- Importa el script generalizado -->

    <script> console.log('Página de edición de renta cargada'); </script>
@stop
