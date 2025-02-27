@extends('adminlte::page')

@section('title', 'Administración de Quincenas')

@section('content_header')
    <h1>Administración de Quincenas</h1>
@stop

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#createQuincenaModal">Crear Quincena</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered" id="quincenas-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Final</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createQuincenaModal" tabindex="-1" role="dialog" aria-labelledby="createQuincenaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createQuincenaModalLabel">Crear Quincena</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('quincenas.storeRedirect') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                            @if ($errors->has('fecha_inicio'))
                                <span class="text-danger">{{ $errors->first('fecha_inicio') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="fecha_final">Fecha Final</label>
                            <input type="date" class="form-control" id="fecha_final" name="fecha_final" required>
                            @if ($errors->has('fecha_final'))
                                <span class="text-danger">{{ $errors->first('fecha_final') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                            @if ($errors->has('descripcion'))
                                <span class="text-danger">{{ $errors->first('descripcion') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/jszip.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/vfs_fonts.js') }}"></script>
    <script>
        $(function() {
            $('#quincenas-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('quincenas.indexPagina') }}',
                columns: [
                    { data: 'id_quincena', name: 'id_quincena' },
                    { data: 'fecha_inicio', name: 'fecha_inicio' },
                    { data: 'fecha_final', name: 'fecha_final' },
                    { data: 'descripcion', name: 'descripcion' }
                ]
            });

            @if ($errors->any())
                $('#createQuincenaModal').modal('show');
            @endif
        });
    </script>
@stop