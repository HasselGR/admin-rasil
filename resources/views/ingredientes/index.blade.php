@extends('adminlte::page')

@section('title', 'Ingredientes')

@section('content_header')
    <h1>Ingredientes</h1>
@stop

@section('content')
    <a href="{{ route('ingredientes.create') }}" class="btn btn-primary mb-3">Agregar Ingrediente</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Ingrediente</th>
                <th>Cantidad</th>
                <th>Unidad de Medida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ingredientes as $ingrediente)
            <tr>
                <td>{{ $ingrediente->id_ingrediente }}</td>
                <td>{{ $ingrediente->nombre_ingrediente }}</td>
                <td>{{ $ingrediente->cantidad }}</td>
                <td>{{ $ingrediente->unidad_medida }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('ingredientes.show', $ingrediente->id_ingrediente) }}">Mostrar</a>
                    <a class="btn btn-primary" href="{{ route('ingredientes.edit', $ingrediente->id_ingrediente) }}">Editar</a>
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

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
    <script> console.log('Page loaded.'); </script>
@stop
