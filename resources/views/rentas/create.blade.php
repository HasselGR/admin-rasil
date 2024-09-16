{{-- resources/views/rentas/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Crear Renta de Local')

@section('content_header')
    <h1>Crear Renta de Local</h1>
@stop

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('renta_locales.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_local">Local</label>
            <select class="form-control" id="id_local" name="id_local" required>
                @foreach($locales as $local)
                    <option value="{{ $local->id_local }}">{{ $local->ubicacion }} - Canon: {{ $local->canon }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_cliente">Cliente</label>
            <select class="form-control" id="id_cliente" name="id_cliente" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre_razon_social }} - RIF: {{ $cliente->rif }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
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
            <label for="debe">Debe</label>
            <input type="number" step="0.01" class="form-control" id="debe" name="debe" required>
        </div>
        <div class="form-group">
            <label for="haber">Haber</label>
            <input type="number" step="0.01" class="form-control" id="haber" name="haber" required>
        </div>
        <div class="form-group">
            <label for="retencion_iva">Retención IVA</label>
            <input type="number" step="0.01" class="form-control" id="retencion_iva" name="retencion_iva" required>
        </div>
        <div class="form-group">
            <label for="retencion_isrf">Retención ISRF</label>
            <input type="number" step="0.01" class="form-control" id="retencion_isrf" name="retencion_isrf" required>
        </div>
        <div class="form-group">
            <label for="saldo">Saldo</label>
            <input type="number" step="0.01" class="form-control" id="saldo" name="saldo" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Renta</button>
    </form>
@stop

@section('css')
    {{-- Aquí puedes agregar tus estilos personalizados si es necesario --}}
@stop

@section('js')
    <script> console.log('Página de creación de renta cargada'); </script>
@stop
