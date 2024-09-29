@extends('adminlte::page')

@section('title', 'Agregar Unidad de Medida')

@section('content_header')
    <h1>Agregar Unidad de Medida</h1>
@stop

@section('content')
    <form action="{{ route('unidad_medida.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre_unidad">Nombre de la Unidad</label>
            <input type="text" class="form-control" name="nombre_unidad" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
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
