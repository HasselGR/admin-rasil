@extends('adminlte::page')

@section('title', 'Crear Medida de Plato')

@section('content_header')
    <h1>Crear Medida de Plato</h1>
@stop

@section('content')
    <form action="{{ route('medidas_platos.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="id_plato">Plato</label>
            <select class="form-control" name="id_plato" id="id_plato" required>
                @foreach ($platos as $plato)
                    <option value="{{ $plato->id_plato }}" data-nombre="{{ $plato->nombre_plato }}">{{ $plato->nombre_plato }}</option>
                @endforeach
            </select>
            <input type="hidden" name="nombre_plato" id="nombre_plato">
        </div>

        <div class="form-group">
            <label for="id_ingrediente">Ingrediente</label>
            <select class="form-control" name="id_ingrediente" id="id_ingrediente" required>
                @foreach ($ingredientes as $ingrediente)
                    <option value="{{ $ingrediente->id_ingrediente }}" data-nombre="{{ $ingrediente->nombre_ingrediente }}">{{ $ingrediente->nombre_ingrediente }}</option>
                @endforeach
            </select>
            <input type="hidden" name="nombre_ingrediente" id="nombre_ingrediente">
        </div>

        <div class="form-group">
            <label for="unidad_medida">Unidad de Medida</label>
            <select class="form-control" name="unidad_medida" id="unidad_medida" required>
                @foreach ($unidadesMedida as $unidad)
                    <option value="{{ $unidad->id_unidad_medida }}" data-nombre="{{ $unidad->nombre_unidad }}">{{ $unidad->nombre_unidad }}</option>
                @endforeach
            </select>
            <input type="hidden" name="nombre_unidad" id="nombre_unidad">
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" step="0.01" class="form-control" name="cantidad" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@stop

@section('css')
    {{-- Custom CSS --}}
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Update the hidden input when the select changes
            document.getElementById('id_plato').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                document.getElementById('nombre_plato').value = selectedOption.getAttribute('data-nombre');
            });

            document.getElementById('id_ingrediente').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                document.getElementById('nombre_ingrediente').value = selectedOption.getAttribute('data-nombre');
            });

            document.getElementById('unidad_medida').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                document.getElementById('nombre_unidad').value = selectedOption.getAttribute('data-nombre');
            });

            // Trigger the change event on page load to populate the names if the form is pre-filled
            document.getElementById('id_plato').dispatchEvent(new Event('change'));
            document.getElementById('id_ingrediente').dispatchEvent(new Event('change'));
            document.getElementById('unidad_medida').dispatchEvent(new Event('change'));
        });
    </script>
@stop
