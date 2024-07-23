<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibroVenta;
use App\Models\Quincena;
use Yajra\DataTables\DataTables;


class LibroVentaController extends Controller
{
    public function index()
    {
        return view('libro_venta.index');
    }

    public function data()
    {
        $ventas = LibroVenta::select([
            'id_venta',
            'id_quincena',
            'fecha_factura',
            'nro_rif',
            'prov_razon_social',
            'nro_factura',
            'nro_control_factura',
            'tipo_transaccion',
            'total_ventas',
            'base_impo_contribuyente',
            'alicuota_contribuyente',
            'impuesto_iva_contribuyente',
            'base_impo_no_contribuyente',
            'alicuota_no_contribuyente',
            'impuesto_iva_no_contribuyente',
            'iva_retenido',
            'nro_comprobante',
            'fecha_comprobante_retencion',
        ]);

        return DataTables::of($ventas)
            ->make(true);
    }

    public function create()
    {
        $quincenas = Quincena::all();
        return view('libro_venta.venta_create', compact('quincenas'));
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
            'total_ventas' => 'required|numeric',
            'base_impo_contribuyente' => 'required|numeric',
            'alicuota_contribuyente' => 'required|numeric',
            'impuesto_iva_contribuyente' => 'required|numeric',
            'base_impo_no_contribuyente' => 'nullable|numeric',
            'alicuota_no_contribuyente' => 'nullable|numeric',
            'impuesto_iva_no_contribuyente' => 'nullable|numeric',
            'iva_retenido' => 'nullable|numeric',
            'nro_comprobante' => 'nullable|integer',
            'fecha_comprobante_retencion' => 'nullable|date',
        ]);

        LibroVenta::create($request->all());

        return redirect()->route('main.mainpage')->with('success', 'Venta creada con éxito');
    }

    public function show($id)
    {
        $venta = LibroVenta::findOrFail($id);
        return view('libro_venta.show', compact('venta'));
    }

    public function edit($id)
    {
        $venta = LibroVenta::findOrFail($id);
        $quincenas = Quincena::all();
        return view('libro_venta.edit', compact('venta', 'quincenas'));
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
            'total_ventas' => 'required|numeric',
            'base_impo_contribuyente' => 'required|numeric',
            'alicuota_contribuyente' => 'required|numeric',
            'impuesto_iva_contribuyente' => 'required|numeric',
            'base_impo_no_contribuyente' => 'nullable|numeric',
            'alicuota_no_contribuyente' => 'nullable|numeric',
            'impuesto_iva_no_contribuyente' => 'nullable|numeric',
            'iva_retenido' => 'nullable|numeric',
            'nro_comprobante' => 'nullable|integer',
            'fecha_comprobante_retencion' => 'nullable|date',
        ]);

        $venta = LibroVenta::findOrFail($id);
        $venta->update($request->all());

        return redirect()->route('libro_venta.index')->with('success', 'Venta actualizada con éxito');
    }

    public function destroy($id)
    {
        $venta = LibroVenta::findOrFail($id);
        $venta->delete();

        return redirect()->route('libro_venta.index')->with('success', 'Venta eliminada con éxito');
    }
}
