<?php

namespace App\Http\Controllers;

use App\Models\Plato;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PlatoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $platos = Plato::select(['id_plato', 'nombre_plato', 'costo', 'descripcion']);

            return DataTables::of($platos)
                ->addColumn('acciones', function ($plato) {
                    return '
                        <a href="' . route('plato.show', $plato->id_plato) . '" class="btn btn-info">Mostrar</a>
                        <a href="' . route('plato.edit', $plato->id_plato) . '" class="btn btn-primary">Editar</a>
                        <form action="' . route('plato.destroy', $plato->id_plato) . '" method="POST" style="display:inline-block;" class="form-eliminar">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>';
                })
                ->rawColumns(['acciones'])
                ->make(true);
        }

            
            {
                $platos = Plato::all();
                return view('plato.index', compact('platos'));
            }
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
