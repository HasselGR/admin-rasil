<?php
// app/Http/Controllers/ClienteRentaController.php
namespace App\Http\Controllers;

use App\Models\ClienteRenta;
use Illuminate\Http\Request;

class ClienteRentaController extends Controller
{
    public function index()
    {   
        $clientes = ClienteRenta::all();
        return view('clientes.index', compact('clientes'));
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
