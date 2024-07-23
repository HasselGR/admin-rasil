<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibroCompra;
use App\Models\Quincena;
use Yajra\DataTables\DataTables;


class LibroCompraController extends Controller
{
    public function index()
    {
        return view('libro_compra.index');
    }

    public function data()
    {
        $compras = LibroCompra::select([
            'id_compra',
            'id_quincena',
            'fecha_factura',
            'nro_rif',
            'prov_razon_social',
            'nro_factura',
            'nro_control_factura',
            'tipo_transaccion',
            'nro_factura_afectada',
            'total_compras',
            'compras_sin_derecho_iva',
            'descuento_tgif',
            'base_impo_contribuyente',
            'alicuota_contribuyente',
            'impuesto_iva_contribuyente',
            'base_impo_contribuyente_alic_red',
            'alicuota_contribuyente_alic_red',
            'impuesto_iva_contribuyente_alic_red',
            'iva_retenido',
            'nro_comprobante',
            'fecha_comprobante_retencion',
        ]);

        return DataTables::of($compras)
            ->make(true);
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
            'iva_retenido' => 'nullable|numeric',
            'nro_comprobante' => 'nullable|integer',
            'fecha_comprobante_retencion' => 'nullable|date',
        ]);

        LibroCompra::create($request->all());

        return redirect()->route('main.mainpage')->with('success', 'Compra creada con éxito');
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
