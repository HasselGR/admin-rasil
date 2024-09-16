<?php
// app/Http/Controllers/RentaLocalesController.php
namespace App\Http\Controllers;

use App\Models\RentaLocales;
use App\Models\LocalRenta;
use App\Models\ClienteRenta;
use Illuminate\Http\Request;

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

        RentaLocales::create($request->all());

        return redirect()->route('renta_locales.index')->with('success', 'Renta creada con éxito');
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
