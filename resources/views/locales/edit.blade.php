{{-- resources/views/locales/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Editar Local')

@section('content_header')
    <h1>Editar Local</h1>
@stop

@section('content')
    <form action="{{ route('local_renta.update', $local->id_local) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="ubicacion">Ubicación</label>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="{{ $local->ubicacion }}" required>
        </div>
        <div class="form-group">
            <label for="canon">Canon</label>
            <input type="number" step="0.01" class="form-control" id="canon" name="canon" value="{{ $local->canon }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Local</button>
    </form>
@stop

@section('css')
    {{-- Aquí puedes agregar tus estilos personalizados si es necesario --}}
@stop

@section('js')
    <script> console.log('Página de edición de local cargada'); </script>
@stop
