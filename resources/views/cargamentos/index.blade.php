@extends('adminlte::page')

@section('title', 'Lista de Cargamentos')

@section('content_header')
    <h1>Lista de Cargamentos</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Número de Factura</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cargamentos as $cargamento)
                <tr>
                    <td>{{ $cargamento->id_cargamento }}</td>
                    <td>{{ $cargamento->fecha }}</td>
                    <td>{{ $cargamento->nro_factura }}</td>
                    <td>
                        <a href="{{ route('cargamentos.show', $cargamento->id_cargamento) }}" class="btn btn-info">Ver</a>
                        <form action="{{ route('cargamentos.destroy', $cargamento->id_cargamento) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este cargamento?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('css')
    {{-- Agregar estilos adicionales si los hay --}}
@stop

@section('js')
    <script> console.log('Página de lista de cargamentos cargada.'); </script>
@stop
