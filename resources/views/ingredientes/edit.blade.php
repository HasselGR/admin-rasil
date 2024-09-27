@extends('adminlte::page')

@section('title', 'Editar Ingrediente')

@section('content_header')
    <h1>Editar Ingrediente</h1>
@stop

@section('content')
    <form action="{{ route('ingredientes.update', $ingrediente->id_ingrediente) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre_ingrediente">Nombre del Ingrediente</label>
            <input type="text" class="form-control" name="nombre_ingrediente" value="{{ $ingrediente->nombre_ingrediente }}" required>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" step="0.01" class="form-control" name="cantidad" value="{{ $ingrediente->cantidad }}" required>
        </div>

        <div class="form-group">
            <label for="unidad_medida">Unidad de Medida</label>
            <select class="form-control" name="unidad_medida" required>
                @foreach ($unidadMedidas as $unidadMedida)
                    <option value="">Seleccione una opción</option>
                    <option value="{{ $unidadMedida->id_unidad_medida }}" {{ $ingrediente->unidad_medida == $unidadMedida->id_unidad_medida ? 'selected' : '' }}>
                        {{ $unidadMedida->nombre_unidad }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="{{ route('ingredientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
    <script> console.log('Page loaded.'); </script>
@stop
