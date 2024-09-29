
@extends('adminlte::page')

@section('title', 'Lista de Locales')

@section('content_header')
    <h1>Lista de Locales de Renta</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <a href="{{ route('locales.create') }}" class="btn btn-primary mb-3">Crear Nuevo Local</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ubicación</th>
                <th>Nombre Local</th>
                <th>Canon</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($locales as $local)
                <tr>
                    <td>{{ $local->id_local }}</td>
                    <td>{{ $local->ubicacion }}</td>
                    <td>{{ $local->nombre_local }}</td>
                    <td>{{ $local->canon }}</td>
                    <td>
                        <a href="{{ route('locales.edit', $local->id_local) }}" class="btn btn-info">Editar</a>
                        <form action="{{ route('locales.destroy', $local->id_local) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este local?')"> Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('css')
    {{-- Aquí puedes agregar tus estilos personalizados si es necesario --}}
@stop

@section('js')




@stop
