<?php

namespace App\Http\Controllers;

use App\Models\UnidadMedida;
use Illuminate\Http\Request;
 use Yajra\DataTables\DataTables;
class UnidadMedidaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $unidadMedidas = UnidadMedida::select(['id_unidad_medida', 'nombre_unidad']);

            return DataTables::of($unidadMedidas)
                ->addColumn('acciones', function ($unidadMedida) {
                    return '
                        <a href="'.route('unidad_medida.show', $unidadMedida->id_unidad_medida).'" class="btn btn-info">Mostrar</a>
                        <a href="'.route('unidad_medida.edit', $unidadMedida->id_unidad_medida).'" class="btn btn-primary">Editar</a>
                        <form action="'.route('unidad_medida.destroy', $unidadMedida->id_unidad_medida).'" method="POST" style="display:inline-block;" class="form-eliminar">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>';
                })
                ->rawColumns(['acciones'])
                ->make(true);
        }
        return view('unidad_medida.index');
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
