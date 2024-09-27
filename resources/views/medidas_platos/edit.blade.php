@extends('adminlte::page')

@section('title', 'Editar Medida del Plato')

@section('content_header')
    <h1>Editar Medida del Plato</h1>
@stop

@section('content')
    <form action="{{ route('medidas_platos.update', $medidaPlato->id_medida_plato) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_plato">Plato</label>
            <select class="form-control" name="id_plato" required>
                <option value="">Seleccione una opción</option>
                @foreach ($platos as $plato)
                    <option value="{{ $plato->id_plato }}" {{ $plato->id_plato == $medidaPlato->id_plato ? 'selected' : '' }}>
                        {{ $plato->nombre_plato }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="id_ingrediente">Ingrediente</label>
            <select class="form-control" name="id_ingrediente" required>
                <option value="">Seleccione una opción</option>
                @foreach ($ingredientes as $ingrediente)
                    <option value="{{ $ingrediente->id_ingrediente }}" {{ $ingrediente->id_ingrediente == $medidaPlato->id_ingrediente ? 'selected' : '' }}>
                        {{ $ingrediente->nombre_ingrediente }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="unidad_medida">Unidad de Medida</label>
            <select class="form-control" name="unidad_medida" required>
                <option value="">Seleccione una opción</option>
                @foreach ($unidadesMedida as $unidadMedida)
                    <option value="{{ $unidadMedida->id_unidad_medida }}" {{ $unidadMedida->id_unidad_medida == $medidaPlato->unidad_medida ? 'selected' : '' }}>
                        {{ $unidadMedida->nombre_unidad }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" step="0.01" class="form-control" name="cantidad
