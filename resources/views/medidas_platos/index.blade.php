@extends('adminlte::page')

@section('title', 'Medidas de Platos')

@section('content_header')
    <h1>Medidas de Platos</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <a href="{{ route('medidas_platos.create') }}" class="btn btn-primary mb-3">Agregar Medida de Plato</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Plato</th>
                <th>Ingrediente</th>
                <th>Unidad de Medida</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medidasPlatos as $medidaPlato)
                <tr>
                    <td>{{ $medidaPlato->plato->nombre_plato }}</td>
                    <td>{{ $medidaPlato->ingrediente->nombre_ingrediente }}</td>
                    <td>{{ $medidaPlato->unidadMedida->nombre_unidad }}</td>
                    <td>{{ $medidaPlato->cantidad }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('medidas_platos.edit', $medidaPlato->id_medida_plato) }}">Editar</a>
                        <form action="{{ route('medidas_platos.destroy', $medidaPlato->id_medida_plato) }}" method="POST" style="display:inline-block;">
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
