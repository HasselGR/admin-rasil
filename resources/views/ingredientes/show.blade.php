@extends('adminlte::page')

@section('title', 'Mostrar Ingrediente')

@section('content_header')
    <h1>Detalle del Ingrediente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ $ingrediente->nombre_ingrediente }}</h3>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $ingrediente->id_ingrediente }}</p>
            <p><strong>Nombre del Ingrediente:</strong> {{ $ingrediente->nombre_ingrediente }}</p>
            <p><strong>Cantidad:</strong> {{ $ingrediente->cantidad }}</p>
            <p><strong>Unidad de Medida:</strong> {{ $ingrediente->unidadMedida->nombre_unidad }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('ingredientes.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('ingredientes.edit', $ingrediente->id_ingrediente) }}" class="btn btn-primary">Editar</a>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
    <script> console.log('Page loaded.'); </script>
@stop
