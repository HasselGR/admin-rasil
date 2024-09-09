<?php

namespace App\Http\Controllers;

use App\Models\IngredienteCargamento;
use App\Models\Ingrediente;
use Illuminate\Http\Request;

class IngredientesCargamentosController extends Controller
{
    // Método para mostrar detalles de los ingredientes en un cargamento
    public function index()
    {
        $detalles = IngredienteCargamento::all();
        return view('ingredientes_cargamentos.index', compact('detalles'));
    }

    // Método para editar un ingrediente cargado (en caso que lo necesites)
    public function edit($id)
    {
        $detalle = IngredienteCargamento::find($id);
        $ingredientes = Ingrediente::all();
        return view('ingredientes_cargamentos.edit', compact('detalle', 'ingredientes'));
    }

    // Método para actualizar un detalle de ingrediente cargado
    public function update(Request $request, $id)
    {
        $detalle = IngredienteCargamento::find($id);
        $detalle->update([
            'id_ingrediente' => $request->input('id_ingrediente'),
            'cantidad' => $request->input('cantidad'),
        ]);

        // Opcional: actualizar el inventario si es necesario

        return redirect()->route('ingredientes_cargamentos.index')->with('success', 'Detalle actualizado con éxito');
    }
}
