@extends('adminlte::page')

@section('title', 'Editar Unidad de Medida')

@section('content_header')
    <h1>Editar Unidad de Medida</h1>
@stop

@section('content')
    <form action="{{ route('unidad_medida.update', $unidadMedida->id_unidad_medida) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre_unidad">Nombre de la Unidad</label>
            <input type="text" class="form-control" name="nombre_unidad" value="{{ $unidadMedida->nombre_unidad }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="{{ route('unidad_medida.index') }}" class="btn btn-secondary">Cancelar</a>
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
