@extends('adminlte::page')

@section('title', 'Mostrar Plato')

@section('content_header')
    <h1>Detalle del Plato</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ $plato->nombre_plato }}</h3>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $plato->id_plato }}</p>
            <p><strong>Costo:</strong> {{ $plato->costo }}</p>
            <p><strong>Descripción:</strong> {{ $plato->descripcion }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('plato.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('plato.edit', $plato->id_plato) }}" class="btn btn-primary">Editar</a>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
    <script> console.log('Page loaded.'); </script>
@stop
