<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    public function index()
    {
        $ordenes = Orden::all();
        return view('ordenes.index', compact('ordenes'));
    }

    public function create()
    {
        return view('ordenes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_plato' => 'required|integer|exists:plato,id_plato',
            'nombre_plato' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'id_factura' => 'required|integer',
        ]);

        Orden::create($request->all());

        return redirect()->route('ordenes.index')->with('success', 'Orden creada con éxito.');
    }

    public function show(Orden $orden)
    {
        return view('ordenes.show', compact('orden'));
    }

    public function edit(Orden $orden)
    {
        return view('ordenes.edit', compact('orden'));
    }

    public function update(Request $request, Orden $orden)
    {
        $request->validate([
            'id_plato' => 'required|integer|exists:plato,id_plato',
            'nombre_plato' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'id_factura' => 'required|integer',
        ]);

        $orden->update($request->all());

        return redirect()->route('ordenes.index')->with('success', 'Orden actualizada con éxito.');
    }

    public function destroy(Orden $orden)
    {
        $orden->delete();

        return redirect()->route('ordenes.index')->with('success', 'Orden eliminada con éxito.');
    }
}
