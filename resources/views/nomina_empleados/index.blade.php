@extends('adminlte::page')

@section('title', 'Nómina de Empleados')

@section('content_header')
    <h1>Nómina de Empleados</h1>
@stop

@section('content')
    <a href="{{ route('nomina-empleados.create') }}" class="btn btn-primary mb-3">Agregar Empleado</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cédula</th>
                <th>Código de Contrato</th>
                <th>Salario Gobierno</th>
                <th>Salario Empresa</th>
                <th width="280px">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nominaEmpleados as $nominaEmpleado)
            <tr>
                <td>{{ $nominaEmpleado->nombre_empleado }}</td>
                <td>{{ $nominaEmpleado->cedula_identidad }}</td>
                <td>{{ $nominaEmpleado->cod_contrato }}</td>
                <td>{{ $nominaEmpleado->salario_gobierno }}</td>
                <td>{{ $nominaEmpleado->salario_empresa }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('nomina-empleados.show', $nominaEmpleado->id_empleado) }}">Mostrar</a>
                    <a class="btn btn-primary" href="{{ route('nomina-empleados.edit', $nominaEmpleado->id_empleado) }}">Editar</a>
                    <a class="btn btn-warning" href="{{ route('nomina-empleados.horas', $nominaEmpleado->id_empleado) }}">Ver Asignaciones y Deducciones</a>
                    <form action="{{ route('nomina-empleados.destroy', $nominaEmpleado->id_empleado) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script> console.log('Page loaded.'); </script>
@stop