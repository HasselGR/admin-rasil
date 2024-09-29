@extends('adminlte::page')

@section('title', 'Crear Orden')

@section('content_header')
    <h1>Crear Orden</h1>
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

    @if (Session::has('warning'))
    <div class="alert alert-warning">
        <ul>
            @foreach (Session::get('warning') as $warning)
                <li>{{ $warning }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="orden-form">
        @csrf
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" name="fecha" required>
        </div>
        <div class="form-group">
            <label for="hora">Hora</label>
            <input type="time" class="form-control" name="hora" required>
        </div>
        <hr>

        <h3>Detalles de la Orden</h3>
        <div id="detalles-repeater">
            <div class="detalle-item form-group">
                <label for="plato_id">Plato</label>
                <select class="form-control" name="plato_id[]" required>
                    <option value="">Seleccione una opción</option>
                    @foreach ($platos as $plato)
                        <option value="{{ $plato->id_plato }}" data-precio="{{ $plato->costo }}">{{ $plato->nombre_plato }}</option>
                    @endforeach
                </select>

                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control cantidad-input" name="cantidad[]" min="1" required>

                <label for="precio_unitario">Precio Unitario</label>
                <input type="number" class="form-control precio-unitario-input" name="precio_unitario[]" step="0.01" readonly>

                <label for="total">Total</label>
                <input type="number" class="form-control total-input" name="total[]" step="0.01" readonly>

                <button type="button" class="btn btn-danger remove-detalle mt-3">Eliminar</button>
            </div>
        </div>

        <button type="button" id="add-detalle" class="btn btn-success mb-3">Añadir Plato</button>

        <button type="submit" class="btn btn-primary">Guardar Orden</button>
    </form>
@stop

@section('js')
<script src="{{ asset('vendor/blockui/js/jquery.blockui.min.js') }}"></script>
    <script>

        $(document).ready(function() {
            // Function to update the total when quantity or price is changed
            function updateTotal(detalleItem) {
                var cantidad = $(detalleItem).find('.cantidad-input').val();
                var precioUnitario = $(detalleItem).find('.precio-unitario-input').val();
                var total = cantidad * precioUnitario;
                $(detalleItem).find('.total-input').val(total.toFixed(2));
            }


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

            // Update price when a different plato is selected
            $('#detalles-repeater').on('change', 'select[name="plato_id[]"]', function() {
                var selectedOption = $(this).find('option:selected');
                var precio = selectedOption.data('precio');
                var detalleItem = $(this).closest('.detalle-item');
                $(detalleItem).find('.precio-unitario-input').val(precio);
                updateTotal(detalleItem);
            });

            // Update total when quantity is changed
            $('#detalles-repeater').on('input', '.cantidad-input', function() {
                var detalleItem = $(this).closest('.detalle-item');
                updateTotal(detalleItem);
            });

            // Add new detalle item
            $('#add-detalle').click(function() {
                var newDetalle = $('.detalle-item:first').clone();
                newDetalle.find('input').val('');
                $('#detalles-repeater').append(newDetalle);
            });

            // Remove a detalle item
            $('#detalles-repeater').on('click', '.remove-detalle', function() {
                if ($('.detalle-item').length > 1) {
                    $(this).closest('.detalle-item').remove();
                }
            });

            // Handle the form submission with AJAX
            $('#orden-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission
                var formData = $(this).serialize();
                
                $.ajax({
                    url: '{{ route("orden.store") }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        alert(response.message)
                        window.location.href = '{{ route("orden.index") }}';
                    },
                    error: function(response) {
                        alert('Hubo un error al crear la orden');
                    }
                });
            });
        });
    </script>
@stop
