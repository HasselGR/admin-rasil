@extends('adminlte::page')

@section('title', 'Unidades de Medida')

@section('content_header')
    <h1>Unidades de Medida</h1>
@stop

@section('content')
    <a href="{{ route('unidad_medida.create') }}" class="btn btn-primary mb-3">Agregar Unidad de Medida</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Unidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($unidadMedidas as $unidadMedida)
            <tr>
                <td>{{ $unidadMedida->id_unidad_medida }}</td>
                <td>{{ $unidadMedida->nombre_unidad }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('unidad_medida.show', $unidadMedida->id_unidad_medida) }}">Mostrar</a>
                    <a class="btn btn-primary" href="{{ route('unidad_medida.edit', $unidadMedida->id_unidad_medida) }}">Editar</a>
                    <form action="{{ route('unidad_medida.destroy', $unidadMedida->id_unidad_medida) }}" method="POST" style="display:inline-block;">
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
