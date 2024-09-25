{{-- resources/views/clientes/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Lista de Clientes')

@section('content_header')
    <h1>Lista de Clientes</h1>
@stop

@section('content')
    <a href="{{ route('clientes_renta.create') }}" class="btn btn-primary mb-3">Crear Nuevo Cliente</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre/Razón Social</th>
                <th>RIF</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Saldo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id_cliente }}</td>
                    <td>{{ $cliente->nombre_razon_social }}</td>
                    <td>{{ $cliente->rif }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->correo }}</td>
                    <td>{{ $cliente->saldo }}</td>
                    <td>
                        <a href="{{ route('clientes_renta.edit', $cliente->id_cliente) }}" class="btn btn-info">Editar</a>
                        <form action="{{ route('clientes_renta.destroy', $cliente->id_cliente) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este cliente?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
