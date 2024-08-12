<?php

namespace App\Http\Controllers;

use App\Models\MedidasPlato;
use App\Models\Plato;
use App\Models\Ingrediente;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class MedidasPlatoController extends Controller
{
    public function index()
    {
        $medidasPlatos = MedidasPlato::with(['plato', 'ingrediente', 'unidadMedida'])->get();
        return view('medidas_platos.index', compact('medidasPlatos'));
    }

    public function create()
    {
        $platos = Plato::all();
        $ingredientes = Ingrediente::all();
        $unidadesMedida = UnidadMedida::all();
        return view('medidas_platos.create', compact('platos', 'ingredientes', 'unidadesMedida'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_plato' => 'required|exists:plato,id_plato',
            'nombre_plato' => 'required|string',
            'id_ingrediente' => 'required|exists:ingredientes,id_ingrediente',
            'nombre_ingrediente' => 'required|string',
            'unidad_medida' => 'required|exists:unidad_medida,id_unidad_medida',
            'nombre_unidad' => 'required|string',
            'cantidad' => 'required|numeric',
        ]);

        MedidasPlato::create($request->all());

        return redirect()->route('medidas_platos.index')->with('success', 'Medida del plato creada con éxito');
    }


    public function edit(MedidasPlato $medidaPlato)
    {
        $platos = Plato::all();
        $ingredientes = Ingrediente::all();
        $unidadesMedida = UnidadMedida::all();
        return view('medidas_platos.edit', compact('medidaPlato', 'platos', 'ingredientes', 'unidadesMedida'));
    }

    public function update(Request $request, MedidasPlato $medidaPlato)
    {
        $request->validate([
            'id_plato' => 'required|exists:plato,id_plato',
            'id_ingrediente' => 'required|exists:ingredientes,id_ingrediente',
            'unidad_medida' => 'required|exists:unidad_medida,id_unidad_medida',
            'cantidad' => 'required|numeric',
        ]);

        $medidaPlato->update($request->all());

        return redirect()->route('medidas_platos.index')->with('success', 'Medida del plato actualizada con éxito.');
    }

    public function destroy(MedidasPlato $medidaPlato)
    {
        $medidaPlato->delete();
        return redirect()->route('medidas_platos.index')->with('success', 'Medida del plato eliminada con éxito.');
    }
}
