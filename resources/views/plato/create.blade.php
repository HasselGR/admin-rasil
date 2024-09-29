@extends('adminlte::page')

@section('title', 'Crear Plato')

@section('content_header')
    <h1>Crear Plato</h1>
@stop

@section('content')
    <form action="{{ route('plato.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre_plato">Nombre del Plato</label>
            <input type="text" class="form-control" name="nombre_plato" required>
        </div>
        <div class="form-group">
            <label for="costo">Costo</label>
            <input type="number" step="0.01" class="form-control" name="costo" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('plato.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/blockui/js/jquery.blockui.min.js') }}"></script>
    <script src="{{ asset('js/blockUI.js') }}"></script> <!-- Importa el script generalizado -->

    <script> console.log('Page loaded.'); </script>
@stop
