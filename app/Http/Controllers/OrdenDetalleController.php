<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenDetalle;
use App\Models\Plato;
use App\Models\Orden;

class OrdenDetalleController extends Controller
{
    public function index($ordenId)
    {
        $detalles = OrdenDetalle::where('id_orden', $ordenId)->get();
        $orden = Orden::findOrFail($ordenId);
        return view('ordendetalle.index', compact('detalles', 'orden'));
    }

    public function create($ordenId)
    {
        $platos = Plato::all();
        $orden = Orden::findOrFail($ordenId);
        return view('ordendetalle.create', compact('orden', 'platos'));
    }

    public function store(Request $request, $ordenId)
    {
        $request->validate([
            'id_plato' => 'required|exists:plato,id_plato',
            'cantidad' => 'required|numeric|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        $plato = Plato::findOrFail($request->id_plato);

        OrdenDetalle::create([
            'id_orden' => $ordenId,
            'id_plato' => $plato->id_plato,
            'nombre_plato' => $plato->nombre_plato,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $request->precio_unitario,
            'total' => $request->cantidad * $request->precio_unitario,
        ]);

        return redirect()->route('orden.detalle.index', $ordenId)->with('success', 'Detalle de orden agregado con éxito');
    }

    public function show($id)
    {
        $detalle = OrdenDetalle::findOrFail($id);
        return view('ordendetalle.show', compact('detalle'));
    }

    public function edit($id)
    {
        $detalle = OrdenDetalle::findOrFail($id);
        $platos = Plato::all();
        return view('ordendetalle.edit', compact('detalle', 'platos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_plato' => 'required|exists:plato,id_plato',
            'cantidad' => 'required|numeric|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        $detalle = OrdenDetalle::findOrFail($id);
        $plato = Plato::findOrFail($request->id_plato);

        $detalle->update([
            'id_plato' => $plato->id_plato,
            'nombre_plato' => $plato->nombre_plato,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $request->precio_unitario,
            'total' => $request->cantidad * $request->precio_unitario,
        ]);

        return redirect()->route('orden.detalle.index', $detalle->id_orden)->with('success', 'Detalle de orden actualizado con éxito');
    }

    public function destroy($id)
    {
        $detalle = OrdenDetalle::findOrFail($id);
        $ordenId = $detalle->id_orden;
        $detalle->delete();

        return redirect()->route('orden.detalle.index', $ordenId)->with('success', 'Detalle de orden eliminado con éxito');
    }
}
