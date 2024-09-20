{{-- resources/views/locales/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Crear Local')

@section('content_header')
    <h1>Crear Nuevo Local</h1>
@stop

@section('content')
    <form action="{{ route('locales.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre_local">Nombre del Local</label>
            <input type="text" class="form-control" id="nombre_local" name="nombre_local" required>
        </div>
        <div class="form-group">
            <label for="ubicacion">Ubicación</label>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
        </div>
        <div class="form-group">
            <label for="canon">Canon</label>
            <input type="number" step="0.01" class="form-control" id="canon" name="canon" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Local</button>
    </form>
@stop

@section('css')
    {{-- Aquí puedes agregar tus estilos personalizados si es necesario --}}
@stop

@section('js')
    <script> console.log('Página de creación de local cargada'); </script>
@stop
