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

        return response()->json([
            'success' => true,
            'message' => 'Plato creado con éxito',
            'redirect_url' => route('plato.index'), // URL para redirigir
        ]);
    }

    public function show($id)
    {
        $plato = Plato::findOrFail($id);
        return view('plato.show', compact('plato'));
    }

    public function edit($id)
    {
        $plato = Plato::findOrFail($id);
        return view('plato.edit', compact('plato'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_plato' => 'required|string|max:255',
            'costo' => 'required|numeric',
            'descripcion' => 'nullable|string',
        ]);

        $plato = Plato::findOrFail($id);
        $plato->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Plato actualizado con éxito',
            'redirect_url' => route('plato.index'), // URL para redirigir
        ]);
    }

    public function destroy($id)
    {
        $plato = Plato::findOrFail($id);
        $plato->delete();

        return redirect()->route('plato.index')->with('success', 'Plato eliminado con éxito.');
    }

}
