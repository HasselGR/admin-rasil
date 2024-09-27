@extends('adminlte::page')

@section('title', 'Agregar Ingrediente')

@section('content_header')
    <h1>Agregar Ingrediente</h1>
@stop

@section('content')
    <form action="{{ route('ingredientes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre_ingrediente">Nombre del Ingrediente</label>
            <input type="text" class="form-control" name="nombre_ingrediente" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" step="0.01" class="form-control" name="cantidad" required>
        </div>
        <div class="form-group">
            <label for="unidad_medida">Unidad de Medida</label>
            <select class="form-control" name="unidad_medida" required>
                <option value="">Seleccione una opción</option>
                @foreach ($unidadesMedida as $unidad)
                    <option value="{{ $unidad->id_unidad_medida }}">{{ $unidad->nombre_unidad }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
    <script> console.log('Page loaded.'); </script>
@stop
