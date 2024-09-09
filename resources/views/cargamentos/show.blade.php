@extends('adminlte::page')

@section('title', 'Detalle del Cargamento')

@section('content_header')
    <h1>Detalle del Cargamento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Detalles del Cargamento</h3>
        </div>
        <div class="card-body">
            <p><strong>Fecha:</strong> {{ $cargamento->fecha }}</p>
            <p><strong>Número de Factura:</strong> {{ $cargamento->nro_factura }}</p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h3>Ingredientes Cargados</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ingrediente</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cargamento->ingredientesCargamentos as $detalle)
                        <tr>
                            <td>{{ $detalle->ingrediente->nombre_ingrediente }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('cargamentos.index') }}" class="btn btn-primary mt-3">Volver a la lista</a>
@stop

@section('css')
    {{-- Agregar estilos adicionales si es necesario --}}
@stop

@section('js')
    <script> console.log('Página de detalle de cargamento cargada.'); </script>
@stop
