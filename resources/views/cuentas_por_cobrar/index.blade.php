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
    <table class="table table-bordered">
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
        <tbody>
            @foreach($cuentas as $cuenta)
                <tr>
                    <td>{{ $cuenta->id_factura }}</td>
                    <td>{{ $cuenta->nombre_cliente }}</td>
                    <td>{{ $cuenta->fecha_emision }}</td>
                    <td>{{ $cuenta->fecha_vencimiento }}</td>
                    <td>{{ $cuenta->monto_con_iva }}</td>
                    <td>{{ $cuenta->estado ? 'Pagada '. '(Fecha Pago: '. $cuenta->fecha_pago .')' : 'Pendiente' }}</td>
                    <td>
                        <a href="{{ route('cuentas_por_cobrar.show', $cuenta->id_cuenta) }}" class="btn btn-info">Ver</a>
                        @if(!$cuenta->estado)
                                <a href="{{ route('cuentas_por_cobrar.pago', $cuenta->id_cuenta) }}" class="btn btn-success">Registrar Pago</a>
                        @endif
                        <form action="{{ route('cuentas_por_cobrar.destroy', $cuenta->id_cuenta) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta cuenta?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop


@section('js')

    <script src="{{ asset('js/cuentas_por_cobrar.js') }}"></script>


@stop