{{-- resources/views/medidas_platos/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Editar Medida de Plato')

@section('content_header')
    <h1>Editar Medida de Plato</h1>
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

    <form action="{{ route('medidas_platos.update', $medidaPlato->id_medida_plato) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_plato">Plato</label>
            <select class="form-control" name="id_plato" id="id_plato" required>
                <option value="">Seleccione un plato</option>
                @foreach($platos as $plato)
                    <option value="{{ $plato->id_plato }}" {{ $medidaPlato->id_plato == $plato->id_plato ? 'selected' : '' }}>
                        {{ $plato->nombre_plato }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="id_ingrediente">Ingrediente</label>
            <select class="form-control" name="id_ingrediente" id="id_ingrediente" required>
                <option value="">Seleccione un ingrediente</option>
                @foreach($ingredientes as $ingrediente)
                    <option value="{{ $ingrediente->id_ingrediente }}" {{ $medidaPlato->id_ingrediente == $ingrediente->id_ingrediente ? 'selected' : '' }}>
                        {{ $ingrediente->nombre_ingrediente }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="unidad_medida">Unidad de Medida</label>
            <select class="form-control" name="unidad_medida" id="unidad_medida" required>
                <option value="">Seleccione una unidad de medida</option>
                @foreach($unidadesMedida as $unidad)
                    <option value="{{ $unidad->id_unidad_medida }}" {{ $medidaPlato->unidad_medida == $unidad->id_unidad_medida ? 'selected' : '' }}>
                        {{ $unidad->nombre_unidad }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" step="0.01" class="form-control" id="cantidad" name="cantidad" value="{{ $medidaPlato->cantidad }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
@stop

@section('css')
    {{-- Aquí puedes agregar tus estilos personalizados si es necesario --}}
@stop

@section('js')
    <script src="{{ asset('vendor/blockui/js/jquery.blockui.min.js') }}"></script>
    <script src="{{ asset('js/blockUI.js') }}"></script> <!-- Importa el script generalizado -->
@stop
