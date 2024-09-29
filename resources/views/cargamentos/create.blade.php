@extends('adminlte::page')

@section('title', 'Crear Cargamento')

@section('content_header')
    <h1>Crear Cargamento</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @endif

    <form id="cargamento-form">
        @csrf
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" name="fecha" required>
        </div>

        <div class="form-group">
            <label for="nro_factura">Número de Factura</label>
            <input type="text" class="form-control" name="nro_factura" required>
        </div>

        <h3>Detalles del Cargamento</h3>
        <div id="detalles-repeater">
            <div class="detalle-item form-group">
                <label for="ingrediente_id">Ingrediente</label>
                <select class="form-control" name="ingrediente_id[]" required>
                    <option value="">Seleccione una opción</option>
                    @foreach ($ingredientes as $ingrediente)
                        <option value="{{ $ingrediente->id_ingrediente }}">{{ $ingrediente->nombre_ingrediente }}</option>
                    @endforeach
                </select>

                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" name="cantidad[]" min="1" required>

                <button type="button" class="btn btn-danger remove-detalle mt-3">Eliminar</button>
            </div>
        </div>

        <button type="button" id="add-detalle" class="btn btn-success mb-3">Añadir Ingrediente</button>

        <button type="submit" class="btn btn-primary">Guardar Cargamento</button>
    </form>
@stop

@section('js')
    <script src="{{ asset('vendor/blockui/js/jquery.blockui.min.js') }}"></script>
    <script>
        
        $(document).ready(function() {
            // Agregar nuevo detalle
            $('#add-detalle').click(function() {
                var newDetalle = $('.detalle-item:first').clone();
                newDetalle.find('input').val('');
                $('#detalles-repeater').append(newDetalle);
            });

            // Eliminar detalle
            $('#detalles-repeater').on('click', '.remove-detalle', function() {
                if ($('.detalle-item').length > 1) {
                    $(this).closest('.detalle-item').remove();
                }
            });

            // Manejo del submit con AJAX
            $(document).ajaxStart(function() {
                $.blockUI({
                    message: '<div class="spinner-border" role="status"><span class="sr-only">Cargando...</span></div>',
                    css: {
                        backgroundColor: 'transparent',
                        border: 'none'
                    }
                });
            }).ajaxStop(function() {
                $.unblockUI();
            });


            $('#cargamento-form').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route("cargamentos.store") }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Cargamento creado con éxito');
                        window.location.href = '{{ route("cargamentos.index") }}';
                    },
                    error: function(response) {
                        alert('Hubo un error al crear el cargamento');
                    }
                });
            });
        });
    </script>
@stop
