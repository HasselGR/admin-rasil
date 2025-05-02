{{-- resources/views/rentas/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Lista de Rentas')

@section('content_header')
    <h1>Lista de Rentas</h1>
@stop

@section('content')
    <a href="{{ route('renta_locales.create') }}" class="btn btn-primary mb-3">Crear Nueva Renta</a>

    <table class="table table-bordered" id="rentas-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Local</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Forma de Pago</th>
                <th>Haber</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
           
        </tbody>
    </table>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $('#rentas-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('renta_locales.index') }}',
                columns: [
                    { data: 'id_renta', name: 'id_renta' },
                    { data: 'local.nombre_local', name: 'local.nombre_local' },
                    { data: 'cliente.nombre_razon_social', name: 'cliente.nombre_razon_social' },
                    { data: 'fecha', name: 'fecha' },
                    { data: 'concepto', name: 'concepto' },
                    { data: 'forma_pago', name: 'forma_pago' },
                    { data: 'haber', name: 'haber' },
                    { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
                ]
            });

            $(document).on('submit', '.form-eliminar', function (e) {
                e.preventDefault(); // Previene el envío inmediato
                console.log('Formulario de eliminación enviado');
                // Confirmación
                if (confirm('¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer. Recuerde que si posee otro registro asignado no podrá eliminarlo.')) {
                    const form = this;

                    // Enviar el formulario manualmente con AJAX para manejar errores
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            // Recargar la tabla después de eliminar
                            $('#rentas-table').DataTable().ajax.reload();
                            alert('Registro eliminado exitosamente.');
                        },
                        error: function(xhr) {
                            alert('Error al eliminar el registro' + xhr.responseText);
                        }
                    });
                }
            });
        });

    </script>
@stop