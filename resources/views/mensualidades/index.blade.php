@extends('adminlte::page')

@section('title', 'Lista de Mensualidades')

@section('content_header')
    <h1>Lista de Mensualidades</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('mensualidades.create') }}" class="btn btn-primary mb-3">Agregar Mensualidad</a>

    <table class="table table-bordered" id="mensualidades-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Local</th>
                <th>Cliente</th>
                <th>Debe</th>
                <th>Descripción</th>
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
            $('#mensualidades-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('mensualidades.index') }}',
                columns: [
                    { data: 'id_mensualidad', name: 'id_mensualidad' },
                    { data: 'local.nombre_local', name: 'local.nombre_local' },
                    { data: 'cliente.nombre_razon_social', name: 'cliente.nombre_razon_social' },
                    { data: 'debe', name: 'debe' },
                    { data: 'descripcion', name: 'descripcion' },
                    { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
                ]
            });

            $(document).on('submit', '.form-eliminar', function (e) {
                e.preventDefault(); // Previene el envío inmediato
                console.log('Formulario de eliminación enviado');
                // Confirmación
                if (confirm('¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.  Recuerde que si posee otro registro asignado no podrá eliminarlo.')) {
                    const form = this;

                    // Enviar el formulario manualmente con AJAX para manejar errores
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            // Manejar la respuesta del servidor
                            $('#mensualidades-table').DataTable().ajax.reload();
                            alert(response.message);
                        },
                        error: function(xhr) {
                            // Manejar errores
                            alert('Error al eliminar el registro: ' + xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>


    @stop