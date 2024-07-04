<?php

namespace App\Http\Controllers;

use App\Models\Quincena;
use Illuminate\Http\Request;

class QuincenaController extends Controller
{
    public function index()
    {
        $quincenas = Quincena::all();
        return response()->json($quincenas);
    }

    public function create()
    {
        return view('quincenas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date',
            'descripcion' => 'required|string|max:255',
        ]);

        Quincena::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Quincena creada con éxito'
        ]);
    }

    
    public function edit($id)
    {
        $quincena = Quincena::find($id);

        return view('quincenas.edit', compact('quincena'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date',
            'descripcion' => 'required|string|max:255',
        ]);

        $quincena = Quincena::find($id);
        $quincena->update($request->all());

        return redirect()->route('quincenas.index')->with('success', 'Quincena actualizada con éxito');
    }

    public function destroy($id)
    {
        $quincena = Quincena::find($id);
        $quincena->delete();

        return redirect()->route('quincenas.index')->with('success', 'Quincena eliminada con éxito');
    }
}