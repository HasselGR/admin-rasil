@extends('adminlte::page')

@section('title', 'Listado de Locales de Renta')

@section('content_header')
    <h1>Locales de Renta</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <a href="{{ route('locales.create') }}" class="btn btn-primary mb-3">Agregar Local</a>
    <table class="table table-bordered" id="locales-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Local</th>
                <th>Canon</th>
                <th>Ubicación</th>
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
            $('#locales-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('locales.index') }}',
                columns: [
                    { data: 'id_local', name: 'id_local' },
                    { data: 'nombre_local', name: 'nombre_local' },
                    { data: 'canon', name: 'canon' },
                    { data: 'ubicacion', name: 'ubicacion' },
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
                            alert('registro eliminado correctamente.');
                            $('#locales-table').DataTable().ajax.reload(); // Recarga tabla
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