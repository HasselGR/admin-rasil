@extends('adminlte::page')

@section('title', 'Lista de Platos')

@section('content_header')
    <h1>Lista de Platos</h1>
@stop

@section('content')
    <a href="{{ route('plato.create') }}" class="btn btn-primary mb-3">Agregar Plato</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Costo</th>
                <th>Descripción</th>
                <th width="280px">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($platos as $plato)
            <tr>
                <td>{{ $plato->nombre_plato }}</td>
                <td>{{ $plato->costo }}</td>
                <td>{{ $plato->descripcion }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('plato.show', $plato->id_plato) }}">Mostrar</a>
                    <a class="btn btn-primary" href="{{ route('plato.edit', $plato->id_plato) }}">Editar</a>
                    <form action="{{ route('plato.destroy', $plato->id_plato) }}" method="POST" style="display:inline-block;">
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

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
    <script> console.log('Page loaded.'); </script>
@stop
