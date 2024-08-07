<?php

namespace App\Http\Controllers;

use App\Models\Plato;
use Illuminate\Http\Request;

class PlatoController extends Controller
{
    public function index()
    {
        $platos = Plato::all();
        return view('plato.index', compact('platos'));
    }

    public function create()
    {
        return view('plato.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_plato' => 'required|string|max:255',
            'costo' => 'required|numeric',
            'descripcion' => 'required|string|max:255',
        ]);

        Plato::create($request->all());

        return redirect()->route('plato.index')->with('success', 'Plato creado con éxito.');
    }

    public function show(Plato $plato)
    {
        return view('plato.show', compact('plato'));
    }

    public function edit(Plato $plato)
    {
        return view('plato.edit', compact('plato'));
    }

    public function update(Request $request, Plato $plato)
    {
        $request->validate([
            'nombre_plato' => 'required|string|max:255',
            'costo' => 'required|numeric',
            'descripcion' => 'required|string|max:255',
        ]);

        $plato->update($request->all());

        return redirect()->route('plato.index')->with('success', 'Plato actualizado con éxito.');
    }

    public function destroy(Plato $plato)
    {
        $plato->delete();

        return redirect()->route('plato.index')->with('success', 'Plato eliminado con éxito.');
    }
}
