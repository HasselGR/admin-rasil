@extends('adminlte::page')

@section('title', 'Órdenes')

@section('content_header')
    <h1>Órdenes</h1>
@stop

@section('content')
    <a href="{{ route('orden.create') }}" class="btn btn-primary mb-3">Crear Orden</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>ID Factura</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ordenes as $orden)
            <tr>
                <td>{{ $orden->id_orden }}</td>
                <td>{{ $orden->fecha }}</td>
                <td>{{ $orden->hora }}</td>
                <td>{{ $orden->id_factura }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('orden.show', $orden->id_orden) }}">Mostrar</a>
                    <a class="btn btn-primary" href="{{ route('orden.edit', $orden->id_orden) }}">Editar</a>
                    <form action="{{ route('orden.destroy', $orden->id_orden) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop
