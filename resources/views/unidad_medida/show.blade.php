@extends('adminlte::page')

@section('title', 'Mostrar Unidad de Medida')

@section('content_header')
    <h1>Detalle de la Unidad de Medida</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ $unidadMedida->nombre_unidad }}</h3>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $unidadMedida->id_unidad_medida }}</p>
            <p><strong>Nombre de la Unidad:</strong> {{ $unidadMedida->nombre_unidad }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('unidad_medida.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('unidad_medida.edit', $unidadMedida->id_unidad_medida) }}" class="btn btn-primary">Editar</a>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
    <script> console.log('Page loaded.'); </script>
@stop
