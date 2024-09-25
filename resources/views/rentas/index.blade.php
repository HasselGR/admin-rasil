{{-- resources/views/rentas/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Lista de Rentas')

@section('content_header')
    <h1>Lista de Rentas</h1>
@stop

@section('content')
    <a href="{{ route('renta_locales.create') }}" class="btn btn-primary mb-3">Crear Nueva Renta</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Local</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Forma de Pago</th>
                <th>Debe</th>
                <th>Haber</th>
                <th>Saldo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rentas as $renta)

            <!-- cambiar para rreferir al cliente tambien -->
                <tr> 
                    <td>{{ $renta->id_renta }}</td>
                    <td>{{ $renta->local->ubicacion }}</td>
                    <td>{{ $renta->cliente->nombre_razon_social }}</td>
                    <td>{{ $renta->fecha }}</td>
                    <td>{{ $renta->concepto }}</td>
                    <td>{{ $renta->forma_pago }}</td>
                    <td>{{ $renta->haber }}</td>
                    <td>
                        <a href="{{ route('renta_locales.edit', $renta->id_renta) }}" class="btn btn-info">Editar</a>
                        <form action="{{ route('renta_locales.destroy', $renta->id_renta) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta renta?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
