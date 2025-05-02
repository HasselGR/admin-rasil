@extends('adminlte::page')

@section('title', 'Medidas de Platos')

@section('content_header')
    <h1>Medidas de Platos</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <a href="{{ route('medidas_platos.create') }}" class="btn btn-primary mb-3">Agregar Medida de Plato</a>

    <table class="table table-bordered" id="medidas-platos-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Plato</th>
                <th>Ingrediente</th>
                <th>Unidad de Medida</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody></tbody>
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
            $('#medidas-platos-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('medidas_platos.index') }}',
                columns: [
                    { data: 'id_medida_plato', name: 'id_medida_plato' },
                    { data: 'plato.nombre_plato', name: 'plato.nombre_plato' },
                    { data: 'ingrediente.nombre_ingrediente', name: 'ingrediente.nombre_ingrediente' },
                    { data: 'unidad_medida.nombre_unidad', name: 'unidad_medida.nombre_unidad' },
                    { data: 'cantidad', name: 'cantidad' },
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
                            $('#medidas-platos-table').DataTable().ajax.reload(); // Recarga tabla
                        },
                        error: function (xhr, status, error) {
                            console.error('Error al eliminar:', error);
                            alert('Ocurrió un error al intentar el  iminar el registro. Recuerde que si posee un registro asignado no podrá eliminarlo.');
                        }
                    });
                }
            });
        });
    </script>
@stop
