<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class IngredientesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ingredientes = Ingrediente::with('unidadMedida')->select(['id_ingrediente', 'nombre_ingrediente', 'cantidad', 'unidad_medida']);
            
            return DataTables::of($ingredientes)
                ->addColumn('unidad_medida', function ($ingrediente) {
                    return $ingrediente->unidadMedida->nombre_unidad ?? 'N/A';
                })
                ->addColumn('acciones', function ($ingrediente) {
                    return '
                        <a href="'.route('ingredientes.show', $ingrediente->id_ingrediente).'" class="btn btn-info">Mostrar</a>
                        <a href="'.route('ingredientes.edit', $ingrediente->id_ingrediente).'" class="btn btn-primary">Editar</a>
                        <form action="'.route('ingredientes.destroy', $ingrediente->id_ingrediente).'" method="POST" style="display:inline-block;">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>';
                })
                ->rawColumns(['acciones'])
                ->make(true);
        }

        return view('ingredientes.index');
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
