@extends('adminlte::page')

@section('title', 'Listado de Ingredientes')

@section('content_header')
    <h1>Ingredientes</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <a href="{{ route('ingredientes.create') }}" class="btn btn-primary mb-3">Agregar Ingrediente</a>
    <table class="table table-bordered w-75" id="ingredientes-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Ingrediente</th>
                <th>Cantidad</th>
                <th>Unidad de Medida</th>
                <th>Acciones</th>
            </tr>
        </thead>
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
            $('#ingredientes-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('ingredientes.index') }}',
                columns: [
                    { data: 'id_ingrediente', name: 'id_ingrediente' },
                    { data: 'nombre_ingrediente', name: 'nombre_ingrediente' },
                    { data: 'cantidad', name: 'cantidad', render: function(data, type, row) {
                        return data < 0 ? '<span class="text-danger font-weight-bold">' + data + '</span>' : data;
                    }},
                    { data: 'unidad_medida', name: 'unidad_medida', defaultContent: 'N/A' },
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
                    method: $(form).attr('method'),
                    data: $(form).serialize(),
                    success: function (response) {
                        // Puedes mostrar una alerta o recargar la tabla
                        alert('Registro eliminado correctamente.');
                        $('#ingredientes-table').DataTable().ajax.reload(); // Recarga tabla
                    },
                    error: function (xhr, status, error) {
                        console.error('Error al eliminar:', error);
                        alert('Ocurrió un error al intentar eliminar el registro. Recuerde que si posee un registro asignado no podrá eliminarlo.');
                    }
                });
            }
        });
        });
    </script>
@stop
