<?php

// app/Http/Controllers/LocalRentaController.php
namespace App\Http\Controllers;

use App\Models\LocalRenta;
use Illuminate\Http\Request;

class LocalRentaController extends Controller
{
    public function index()
    {
        $locales = LocalRenta::all();
        return view('locales.index', compact('locales'));
    }

    public function create()
    {
        return view('locales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ubicacion' => 'required',
            'canon' => 'required|numeric',
        ]);

        LocalRenta::create($request->all());

        return redirect()->route('locales.index')->with('success', 'Local creado con éxito');
    }

    public function edit($id)
    {
        $local = LocalRenta::find($id);
        return view('locales.edit', compact('local'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ubicacion' => 'required',
            'canon' => 'required|numeric',
        ]);

        $local = LocalRenta::find($id);
        $local->update($request->all());

        return redirect()->route('locales.index')->with('success', 'Local actualizado con éxito');
    }

    public function destroy($id)
    {
        LocalRenta::find($id)->delete();
        return redirect()->route('locales.index')->with('success', 'Local eliminado con éxito');
    }
}
