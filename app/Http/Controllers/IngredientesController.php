<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class IngredientesController extends Controller
{
    public function index()
    {
        $ingredientes = Ingrediente::with('unidadMedida')->get(); // Carga la relación con la tabla unidad_medida
    
        return view('ingredientes.index', compact('ingredientes'));
    }
    

    public function create()
    {   
        $unidadesMedida = UnidadMedida::all();
        return view('ingredientes.create', compact('unidadesMedida'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_ingrediente' => 'required|string|max:255',
            'cantidad' => 'required|numeric',
            'unidad_medida' => 'required|integer|exists:unidad_medida,id_unidad_medida',
        ]);

        Ingrediente::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Ingrediente creado con éxito',
            'redirect_url' => route('ingredientes.index'), // URL para redirigir
        ]);
    }

    public function show($id)
    {
        $ingrediente = Ingrediente::findOrFail($id);
        return view('ingredientes.show', compact('ingrediente'));
    }

    public function edit($id)
    {
        $ingrediente = Ingrediente::findOrFail($id);
        $unidadMedidas = UnidadMedida::all();
        return view('ingredientes.edit', compact('ingrediente', 'unidadMedidas'));
    }

    public function update(Request $request, Ingrediente $ingrediente)
    {
        $request->validate([
            'nombre_ingrediente' => 'required|string|max:255',
            'cantidad' => 'required|numeric',
            'unidad_medida' => 'required|integer|exists:unidad_medida,id_unidad_medida',
        ]);

        $ingrediente->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Ingrediente editado con éxito',
            'redirect_url' => route('ingredientes.index'), // URL para redirigir
        ]);
    }

    public function destroy(Ingrediente $ingrediente)
    {
        $ingrediente->delete();

        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente eliminado con éxito.');
    }
}
