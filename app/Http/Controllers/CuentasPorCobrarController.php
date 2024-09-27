<?php

namespace App\Http\Controllers;

use App\Models\CuentasPorCobrar;
use App\Models\ClienteRenta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class CuentasPorCobrarController extends Controller
{
    // Listar todas las cuentas por cobrar
    public function index()
    {
        // Obtener todas las cuentas con su cliente relacionado
        $cuentas = CuentasPorCobrar::with('cliente')->get(); 
    
        // Obtener todos los clientes para usarlos en la vista
        $clientes = ClienteRenta::all();
    
        // Pasar ambos conjuntos de datos a la vista
        return view('cuentas_por_cobrar.index', compact('cuentas', 'clientes'));
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

    public function imprimir($id_cliente)
{
    // Obtener el cliente por su ID
    $cliente = ClienteRenta::find($id_cliente);

    // Obtener todas las cuentas por cobrar del cliente seleccionado
    $cuentasPorCobrar = CuentasPorCobrar::where('id_cliente', $id_cliente)->get();

    // Calcular el total a pagar
    $totalAPagar = $cuentasPorCobrar->where('estado', false)->sum('monto_con_iva');

    // Preparar los datos para la vista PDF
    $data = [
        'cliente' => $cliente,
        'cuentasPorCobrar' => $cuentasPorCobrar,
        'totalAPagar' => $totalAPagar,
    ];

    // Generar el PDF usando la vista `cuentas_por_cobrar.imprimir`
    $pdf = PDF::loadView('cuentas_por_cobrar.imprimir', $data);

    // Descargar el archivo PDF
    return $pdf->download('informe_cuentas_'.$cliente->nombre_razon_social.'.pdf');
}


}
