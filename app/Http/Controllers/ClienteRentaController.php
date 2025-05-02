<?php
// app/Http/Controllers/ClienteRentaController.php
namespace App\Http\Controllers;

use App\Models\ClienteRenta;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class ClienteRentaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $clientes = ClienteRenta::select(['id_cliente', 'nombre_razon_social', 'rif', 'telefono', 'correo', 'saldo']);
            
            return DataTables::of($clientes)
                ->addColumn('acciones', function ($cliente) {
                    return '
                        <a href="'.route('clientes_renta.edit', $cliente->id_cliente).'" class="btn btn-primary">Editar</a>
                        <form action="'.route('clientes_renta.destroy', $cliente->id_cliente).'" method="POST" style="display:inline-block;" " class="form-eliminar" >
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>';
                })
                ->rawColumns(['acciones'])
                ->make(true);
        }

        return view('clientes.index');
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_razon_social' => 'required',
            'rif' => 'required|unique:clientes_renta,rif',
            'telefono' => 'required',
            'correo' => 'required|email|unique:clientes_renta,correo',
        ]);

        ClienteRenta::create($request->all());
        return response()->json([
            'success' => true,
            'redirect_url' => route('clientes_renta.index'), // URL para redirigir
        ]);
    }

    public function edit($id)
    {
        $cliente = ClienteRenta::find($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_razon_social' => 'required',
            'rif' => 'required|unique:clientes_renta,rif,' . $id . ',id_cliente',
            'telefono' => 'required|numeric',
            'correo' => 'required|email|unique:clientes_renta,correo,' . $id . ',id_cliente',
        ]);

        $cliente = ClienteRenta::find($id);
        $cliente->update($request->all());

        return redirect()->route('clientes_renta.index')->with('success', 'Cliente actualizado con éxito');
    }

    public function destroy($id)
    {
        ClienteRenta::find($id)->delete();
        return redirect()->route('clientes_renta.index')->with('success', 'Cliente eliminado con éxito');
    }
}
