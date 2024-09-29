<?php

namespace App\Http\Controllers;

use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class UnidadMedidaController extends Controller
{
    public function index()
    {
        $unidadMedidas = UnidadMedida::all();
        return view('unidad_medida.index', compact('unidadMedidas'));
    }

    public function create()
    {
        return view('unidad_medida.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_unidad' => 'required|string|max:255',
        ]);

        UnidadMedida::create($request->all());

       

    return response()->json([
        'success' => true,
        'message' => 'Unidad de medida creada con éxito',
        'redirect_url' => route('unidad_medida.index'), // URL para redirigir
    ]);
    }

    public function show(UnidadMedida $unidadMedida)
    {
        return view('unidad_medida.show', compact('unidadMedida'));
    }

    public function edit(UnidadMedida $unidadMedida)
    {
        return view('unidad_medida.edit', compact('unidadMedida'));
    }

    public function update(Request $request, UnidadMedida $unidadMedida)
    {
        $request->validate([
            'nombre_unidad' => 'required|string|max:255',
        ]);

        $unidadMedida->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Unidad de medida actualizada con éxito',
            'redirect_url' => route('unidad_medida.index'), // URL para redirigir
        ]);
    }

    public function destroy(UnidadMedida $unidadMedida)
    {
        $unidadMedida->delete();

        return redirect()->route('unidad_medida.index')->with('success', 'Unidad de medida eliminada con éxito.');
    }
}
