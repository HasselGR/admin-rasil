@extends('adminlte::page')

@section('title', 'Editar Plato')

@section('content_header')
    <h1>Editar Plato</h1>
@stop

@section('content')
    <form action="{{ route('plato.update', $plato->id_plato) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre_plato">Nombre del Plato</label>
            <input type="text" class="form-control" name="nombre_plato" value="{{ $plato->nombre_plato }}" required>
        </div>
        <div class="form-group">
            <label for="costo">Costo</label>
            <input type="number" step="0.01" class="form-control" name="costo" value="{{ $plato->costo }}" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion">{{ $plato->descripcion }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="{{ route('plato.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
    <script> console.log('Page loaded.'); </script>
@stop

