<?php

// app/Http/Controllers/LocalRentaController.php
namespace App\Http\Controllers;

use App\Models\LocalRenta;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LocalRentaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $locales = LocalRenta::select(['id_local', 'nombre_local', 'canon', 'ubicacion']);
            
            return DataTables::of($locales)
                ->addColumn('acciones', function ($local) {
                    return '
                        <a href="'.route('locales.edit', $local->id_local).'" class="btn btn-primary">Editar</a>
                        <form action="'.route('locales.destroy', $local->id_local).'" method="POST" style="display:inline-block;" class="form-eliminar">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>';
                })
                ->rawColumns(['acciones'])
                ->make(true);
        }

        return view('locales.index');
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
            'nombre_local' => 'required|string|max:255',
        ]);

        LocalRenta::create($request->all());

        return response()->json([
            'success' => true,
            'redirect_url' => route('locales.index'), // URL para redirigir
        ]);
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
            'nombre_local' => 'required|string|max:255',
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
