@extends('adminlte::page')

@section('title', 'Detalles de la Medida del Plato')

@section('content_header')
    <h1>Detalles de la Medida del Plato</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ $medidaPlato->plato->nombre_plato }} - {{ $medidaPlato->ingrediente->nombre_ingrediente }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Plato:</strong> {{ $medidaPlato->plato->nombre_plato }}</p>
            <p><strong>Ingrediente:</strong> {{ $medidaPlato->ingrediente->nombre_ingrediente }}</p>
            <p><strong>Unidad de Medida:</strong> {{ $medidaPlato->unidadMedida->nombre_unidad }}</p>
            <p><strong>Cantidad:</strong> {{ $medidaPlato->cantidad }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('medidas_platos.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('medidas_platos.edit', $medidaPlato->id_medida_plato) }}" class="btn btn-primary">Editar</a>
            <form action="{{ route('medidas_platos.destroy', $medidaPlato->id_medida_plato) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
    <script> console.log('Page loaded.'); </script>
@stop