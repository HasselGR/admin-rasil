{{-- resources/views/clientes/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Crear Cliente de Renta')

@section('content_header')
    <h1>Crear Cliente de Renta</h1>
@stop

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('clientes_renta.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre_razon_social">Nombre o Razón Social</label>
            <input type="text" class="form-control" id="nombre_razon_social" name="nombre_razon_social" required>
        </div>
        <div class="form-group">
            <label for="rif">RIF</label>
            <input type="text" class="form-control" id="rif" name="rif" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Cliente</button>
    </form>
@stop

@section('css')
    {{-- Aquí puedes agregar tus estilos personalizados si es necesario --}}
@stop

@section('js')
    <script src="{{ asset('vendor/blockui/js/jquery.blockui.min.js') }}"></script>
    <script src="{{ asset('js/blockUI.js') }}"></script> <!-- Importa el script generalizado -->
@stop
