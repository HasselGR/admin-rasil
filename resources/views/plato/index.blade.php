@extends('adminlte::page')

@section('title', 'Lista de Platos')

@section('content_header')
    <h1>Lista de Platos</h1>
@stop

@section('content')
    <a href="{{ route('plato.create') }}" class="btn btn-primary mb-3">Agregar Plato</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered " id="platos-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Costo</th>
                <th>Descripción</th>
                <th width="280px">Acciones</th>
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
            $('#platos-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('plato.index') }}',
                columns: [
                    { data: 'nombre_plato', name: 'nombre_plato' },
                    { data: 'costo', name: 'costo' },
                    { data: 'descripcion', name: 'descripcion' },
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
                            $('#platos-table').DataTable().ajax.reload();
                            alert(response.message);
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
