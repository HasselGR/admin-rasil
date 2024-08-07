<?php

namespace App\Http\Controllers;

use App\Models\MedidasPlato;
use Illuminate\Http\Request;

class MedidasPlatoController extends Controller
{
    public function index()
    {
        $medidasPlatos = MedidasPlato::all();
        return view('medidas_platos.index', compact('medidasPlatos'));
    }

    public function create()
    {
        return view('medidas_platos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_plato' => 'required|integer|exists:plato,id_plato',
            'id_ingrediente' => 'required|integer|exists:ingredientes,id_ingrediente',
            'unidad_medida' => 'required|integer|exists:unidad_medida,id_unidad_medida',
            'nombre_plato' => 'required|string|max:255',
            'nombre_ingrediente' => 'required|string|max:255',
            'nombre_unidad' => 'required|string|max:255',
        ]);

        MedidasPlato::create($request->all());

        return redirect()->route('medidas_platos.index')->with('success', 'Medida de plato creada con éxito.');
    }

    public function show(MedidasPlato $medidasPlato)
    {
        return view('medidas_platos.show', compact('medidasPlato'));
    }

    public function edit(MedidasPlato $medidasPlato)
    {
        return view('medidas_platos.edit', compact('medidasPlato'));
    }

    public function update(Request $request, MedidasPlato $medidasPlato)
    {
        $request->validate([
            'id_plato' => 'required|integer|exists:plato,id_plato',
            'id_ingrediente' => 'required|integer|exists:ingredientes,id_ingrediente',
            'unidad_medida' => 'required|integer|exists:unidad_medida,id_unidad_medida',
            'nombre_plato' => 'required|string|max:255',
            'nombre_ingrediente' => 'required|string|max:255',
            'nombre_unidad' => 'required|string|max:255',
        ]);

        $medidasPlato->update($request->all());

        return redirect()->route('medidas_platos.index')->with('success', 'Medida de plato actualizada con éxito.');
    }

    public function destroy(MedidasPlato $medidasPlato)
    {
        $medidasPlato->delete();

        return redirect()->route('medidas_platos.index')->with('success', 'Medida de plato eliminada con éxito.');
    }
}
