{{-- resources/views/clientes/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Editar Cliente de Renta')

@section('content_header')
    <h1>Editar Cliente de Renta</h1>
@stop

@section('content')
    <form action="{{ route('clientes_renta.update', $cliente->id_cliente) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre_razon_social">Nombre o Razón Social</label>
            <input type="text" class="form-control" id="nombre_razon_social" name="nombre_razon_social" value="{{ $cliente->nombre_razon_social }}" required>
        </div>
        <div class="form-group">
            <label for="rif">RIF</label>
            <input type="text" class="form-control" id="rif" name="rif" value="{{ $cliente->rif }}" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $cliente->telefono }}" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" value="{{ $cliente->correo }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
    </form>
@stop

@section('css')
    {{-- Aquí puedes agregar tus estilos personalizados si es necesario --}}
@stop

@section('js')
    <script> console.log('Página de edición de cliente cargada'); </script>
@stop
