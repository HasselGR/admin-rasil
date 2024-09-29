@extends('adminlte::page')

@section('title', 'Crear Mensualidad')

@section('content_header')
    <h1>Crear Mensualidad</h1>
@stop

@section('content')
    <form action="{{ route('mensualidades.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="id_local">Local</label>
            <select class="form-control" id="id_local" name="id_local" required>
                <option value="">Seleccione un local</option>
                @foreach($locales as $local)
                    <option value="{{ $local->id_local }}" data-canon="{{ $local->canon }}">{{ $local->nombre_local }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="id_cliente">Cliente</label>
            <select class="form-control" id="id_cliente" name="id_cliente" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre_razon_social }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>


        <div class="form-group">
            
            <label for="debe">Debe</label>
            <input type="number" class="form-control" id="debe" name="debe" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Crear Mensualidad</button>
    </form>
@stop

@section('js')
    <script src="{{ asset('vendor/blockui/js/jquery.blockui.min.js') }}"></script>
    <script src="{{ asset('js/blockUI.js') }}"></script> <!-- Importa el script generalizado -->

    <script>
        $(document).ready(function() {
            // Cuando el select de local cambia
            $('#id_local').on('change', function() {
                // Obtener el canon del local seleccionado (usando el atributo data-canon)
                var canon = $(this).find('option:selected').data('canon');
                
                // Asignar el valor del canon al campo de "Debe"
                $('#debe').val(canon);
            });
        });
    </script>
@stop
