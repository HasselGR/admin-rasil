@extends('adminlte::page')

@section('title', 'Listado de Ingredientes')

@section('content_header')
    <h1>Ingredientes</h1>
@stop

@section('content')
    <a href="{{ route('ingredientes.create') }}" class="btn btn-primary mb-3">Agregar Ingrediente</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Ingrediente</th>
                <th>Cantidad</th>
                <th>Unidad de Medida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ingredientes as $ingrediente)
                <tr>
                    <td>{{ $ingrediente->id_ingrediente }}</td>
                    <td>{{ $ingrediente->nombre_ingrediente }}</td>
                    <td>{{ $ingrediente->cantidad }}</td>
                    <td>{{ $ingrediente->unidadMedida->nombre_unidad ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('ingredientes.show', $ingrediente->id_ingrediente) }}" class="btn btn-info">Mostrar</a>
                        <a href="{{ route('ingredientes.edit', $ingrediente->id_ingrediente) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('ingredientes.destroy', $ingrediente->id_ingrediente) }}" method="POST" style="display:inline-block;">
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
