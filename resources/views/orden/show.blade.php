@extends('adminlte::page')

@section('title', 'Detalle de la Orden')

@section('content_header')
    <h1>Detalle de la Orden #{{ $orden->id_orden }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Encabezado de la Orden</h3>
        </div>
        <div class="card-body">
            <p><strong>Fecha:</strong> {{ $orden->fecha }}</p>
            <p><strong>Hora:</strong> {{ $orden->hora }}</p>
            <p><strong>Factura ID:</strong> {{ $orden->id_factura }}</p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h3>Detalles de la Orden</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Plato</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orden->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->id_detalle }}</td>
                            <td>{{ $detalle->nombre_plato }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>{{ $detalle->precio_unitario }}</td>
                            <td>{{ $detalle->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('orden.index') }}" class="btn btn-secondary mt-3">Volver a Órdenes</a>
@stop
