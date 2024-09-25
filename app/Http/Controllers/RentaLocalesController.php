<?php
// app/Http/Controllers/RentaLocalesController.php
namespace App\Http\Controllers;

use App\Models\RentaLocales;
use App\Models\LocalRenta;
use App\Models\ClienteRenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RentaLocalesController extends Controller
{
    public function index()
    {
        $rentas = RentaLocales::with(['local', 'cliente'])->get();
        return view('rentas.index', compact('rentas'));
    }

    public function create()
    {
        $locales = LocalRenta::all();
        $clientes = ClienteRenta::all();
        return view('rentas.create', compact('locales', 'clientes'));
    }

    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'id_local' => 'required|exists:local_renta,id_local',
        'id_cliente' => 'required|exists:clientes_renta,id_cliente',
        'haber' => 'required|numeric|min:0',
        'concepto' => 'required|string',
        'forma_pago' => 'required|string',
        'retencion_iva' => 'required|numeric|min:0',
        'retencion_isrf' => 'required|numeric|min:0',
    ]);

    try {
        // Iniciar la transacción de base de datos
        DB::beginTransaction();

        // Crear el nuevo registro en renta_locales
        $renta = RentaLocales::create([
            'id_local' => $request->id_local,
            'id_cliente' => $request->id_cliente,
            'haber' => $request->haber,
            'concepto' => $request->concepto,
            'forma_pago' => $request->forma_pago,
            'fecha' => now(), // O la fecha seleccionada
            'retencion_iva' => $request->retencion_iva,
            'retencion_isrf' => $request->retencion_isrf,
        ]);

        // Obtener el cliente para actualizar el saldo
        $cliente = ClienteRenta::find($request->id_cliente);

        if ($cliente) {
            // Restar el monto del haber del saldo del cliente
            $cliente->saldo -= $request->haber;
            $cliente->save();
        }

        // Confirmar la transacción
        DB::commit();

        return redirect()->route('renta_locales.index')->with('success', 'Renta creada y saldo del cliente actualizado correctamente');
    } catch (\Exception $e) {
        // Si ocurre algún error, deshacer la transacción
        DB::rollBack();
        return redirect()->back()->with('error', 'Error al crear la renta: ' . $e->getMessage());
    }
}

    

    public function edit($id)
    {
        $renta = RentaLocales::find($id);
        $locales = LocalRenta::all();
        $clientes = ClienteRenta::all();
        return view('rentas.edit', compact('renta', 'locales', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_local' => 'required|exists:local_renta,id_local',
            'id_cliente' => 'required|exists:clientes_renta,id_cliente',
            'fecha' => 'required|date',
            'concepto' => 'required',
            'forma_pago' => 'required',
            'debe' => 'required|numeric',
            'haber' => 'required|numeric',
            'retencion_iva' => 'required|numeric',
            'retencion_isrf' => 'required|numeric',
            'saldo' => 'required|numeric',
        ]);

        $renta = RentaLocales::find($id);
        $renta->update($request->all());

        return redirect()->route('renta_locales.index')->with('success', 'Renta actualizada con éxito');
    }

    public function destroy($id)
    {
        RentaLocales::find($id)->delete();
        return redirect()->route('renta_locales.index')->with('success', 'Renta eliminada con éxito');
    }
}
