@extends('adminlte::page')

@section('title', 'Lista de Mensualidades')

@section('content_header')
    <h1>Lista de Mensualidades</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('mensualidades.create') }}" class="btn btn-primary mb-3">Agregar Mensualidad</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Local</th>
                <th>Cliente</th>
                <th>Debe</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mensualidades as $mensualidad)
                <tr>
                    <td>{{ $mensualidad->id_mensualidad }}</td>
                    <td>{{ $mensualidad->local->nombre_local }}</td>
                    <td>{{ $mensualidad->cliente->nombre_razon_social }}</td>
                    <td>{{ $mensualidad->debe }}</td>
                    <td>{{ $mensualidad->descripcion }}</td>
                    <td>
                        <a href="{{ route('mensualidades.edit', $mensualidad->id_mensualidad) }}" class="btn btn-warning">Editar</a>

                        <form action="{{ route('mensualidades.destroy', $mensualidad->id_mensualidad) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta mensualidad?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
