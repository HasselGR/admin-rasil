<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibroCompra;
use App\Models\Quincena;

class LibroCompraController extends Controller
{
    public function index()
    {
        $compras = LibroCompra::all();
        return view('libro_compra.index', compact('compras'));
    }

    public function create()
    {
        $quincenas = Quincena::all();
        return view('libro_compra.compra_create', compact('quincenas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_quincena' => 'required|exists:quincenas,id_quincena',
            'fecha_factura' => 'required|date',
            'nro_rif' => 'required|string|max:255',
            'prov_razon_social' => 'required|string|max:255',
            'nro_factura' => 'required|integer',
            'nro_control_factura' => 'required|integer',
            'tipo_transaccion' => 'required|string|max:255',
            'nro_factura_afectada' => 'nullable|integer',
            'total_compras' => 'required|numeric',
            'compras_sin_derecho_iva' => 'nullable|numeric',
            'descuento_tgif' => 'nullable|numeric',
            'base_impo_contribuyente' => 'required|numeric',
            'alicuota_contribuyente' => 'required|numeric',
            'impuesto_iva_contribuyente' => 'required|numeric',
            'base_impo_contribuyente_alic_red' => 'nullable|numeric',
            'alicuota_contribuyente_alic_red' => 'nullable|numeric',
            'impuesto_iva_contribuyente_alic_red' => 'nullable|numeric',
            'base_impo_no_contribuyente_alic_red' => 'nullable|numeric',
            'alicuota_no_contribuyente_alic_red' => 'nullable|numeric',
            'impuesto_iva_no_contribuyente_alic_red' => 'nullable|numeric',
            'iva_retenido' => 'nullable|numeric',
            'nro_comprobante' => 'nullable|integer',
            'fecha_comprobante_retencion' => 'nullable|date',
        ]);

        LibroCompra::create($request->all());

        return redirect()->route('libro_compra.index')->with('success', 'Compra creada con éxito');
    }

    public function show($id)
    {
        $compra = LibroCompra::findOrFail($id);
        return view('libro_compra.show', compact('compra'));
    }

    public function edit($id)
    {
        $compra = LibroCompra::findOrFail($id);
        $quincenas = Quincena::all();
        return view('libro_compra.edit', compact('compra', 'quincenas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_quincena' => 'required|exists:quincenas,id_quincena',
            'fecha_factura' => 'required|date',
            'nro_rif' => 'required|string|max:255',
            'prov_razon_social' => 'required|string|max:255',
            'nro_factura' => 'required|integer',
            'nro_control_factura' => 'required|integer',
            'tipo_transaccion' => 'required|string|max:255',
            'nro_factura_afectada' => 'nullable|integer',
            'total_compras' => 'required|numeric',
            'compras_sin_derecho_iva' => 'nullable|numeric',
            'descuento_tgif' => 'nullable|numeric',
            'base_impo_contribuyente' => 'required|numeric',
            'alicuota_contribuyente' => 'required|numeric',
            'impuesto_iva_contribuyente' => 'required|numeric',
            'base_impo_contribuyente_alic_red' => 'nullable|numeric',
            'alicuota_contribuyente_alic_red' => 'nullable|numeric',
            'impuesto_iva_contribuyente_alic_red' => 'nullable|numeric',
            'base_impo_no_contribuyente_alic_red' => 'nullable|numeric',
            'alicuota_no_contribuyente_alic_red' => 'nullable|numeric',
            'impuesto_iva_no_contribuyente_alic_red' => 'nullable|numeric',
            'iva_retenido' => 'nullable|numeric',
            'nro_comprobante' => 'nullable|integer',
            'fecha_comprobante_retencion' => 'nullable|date',
        ]);

        $compra = LibroCompra::findOrFail($id);
        $compra->update($request->all());

        return redirect()->route('libro_compra.index')->with('success', 'Compra actualizada con éxito');
    }

    public function destroy($id)
    {
        $compra = LibroCompra::findOrFail($id);
        $compra->delete();

        return redirect()->route('libro_compra.index')->with('success', 'Compra eliminada con éxito');
    }
}
