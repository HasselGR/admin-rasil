<?php

namespace App\Http\Controllers;

use App\Models\CuentasPorCobrar;
use App\Models\ClienteRenta;
use Illuminate\Http\Request;

class CuentasPorCobrarController extends Controller
{
    // Listar todas las cuentas por cobrar
    public function index()
    {
        $cuentas = CuentasPorCobrar::with('cliente')->get(); // Obtener todas las cuentas con su cliente
        return view('cuentas_por_cobrar.index', compact('cuentas'));
    }

    // Mostrar formulario para crear una nueva cuenta por cobrar
    public function create()
    {
        $clientes = ClienteRenta::all(); // Obtener todos los clientes para el select
        return view('cuentas_por_cobrar.create', compact('clientes'));
    }

    // Guardar una nueva cuenta por cobrar
    public function store(Request $request)
    {
        $request->validate([
            'id_factura' => 'required|unique:cuentas_por_cobrar,id_factura',
            'id_cliente' => 'required|exists:clientes_renta,id_cliente',
            'nombre_cliente' => 'required',
            'fecha_emision' => 'required|date',
            'fecha_vencimiento' => 'required|date',
            'monto_con_iva' => 'required|numeric',
        ]);

        $cuenta = CuentasPorCobrar::create($request->all());

        return redirect()->route('cuentas_por_cobrar.index')->with('success', 'Cuenta por cobrar creada con éxito.');
    }

    // Mostrar los detalles de una cuenta por cobrar
    public function show($id)
    {
        // Busca la cuenta por cobrar por su ID
        $cuentaPorCobrar = CuentasPorCobrar::findOrFail($id);
    
        // Pasa la cuenta por cobrar a la vista
        return view('cuentas_por_cobrar.show', compact('cuentaPorCobrar'));
    }
    

    // Mostrar formulario para editar una cuenta por cobrar
    public function edit($id)
    {
        $cuenta = CuentasPorCobrar::findOrFail($id);
        $clientes = ClienteRenta::all(); // Obtener todos los clientes para el select
        return view('cuentas_por_cobrar.edit', compact('cuenta', 'clientes'));
    }

    // Actualizar los datos de una cuenta por cobrar
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_factura' => 'required|unique:cuentas_por_cobrar,id_factura,' . $id,
            'id_cliente' => 'required|exists:clientes_renta,id_cliente',
            'nombre_cliente' => 'required',
            'fecha_emision' => 'required|date',
            'fecha_vencimiento' => 'required|date',
            'monto_con_iva' => 'required|numeric',
        ]);

        $cuenta = CuentasPorCobrar::findOrFail($id);
        $cuenta->update($request->all());

        return redirect()->route('cuentas_por_cobrar.index')->with('success', 'Cuenta por cobrar actualizada con éxito.');
    }

    // Eliminar una cuenta por cobrar
    public function destroy($id)
    {
        $cuenta = CuentasPorCobrar::findOrFail($id);
        $cuenta->delete();

        return redirect()->route('cuentas_por_cobrar.index')->with('success', 'Cuenta por cobrar eliminada con éxito.');
    }

    public function pagoForm($id)
    {
        // Busca la cuenta por cobrar por su ID
        $cuentaPorCobrar = CuentasPorCobrar::findOrFail($id);

        // Pasa la cuenta por cobrar a la vista
        return view('cuentas_por_cobrar.pago', compact('cuentaPorCobrar'));
    }

    public function registrarPago(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'fecha_pago' => 'required|date',
        ]);

        // Busca la cuenta por cobrar
        $cuentaPorCobrar = CuentasPorCobrar::findOrFail($id);

        // Actualizar el estado a pagado y la fecha de pago
        $cuentaPorCobrar->estado = true;
        $cuentaPorCobrar->fecha_pago = $request->input('fecha_pago');
        $cuentaPorCobrar->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('cuentas_por_cobrar.index')->with('success', 'Pago registrado exitosamente.');
}

}
