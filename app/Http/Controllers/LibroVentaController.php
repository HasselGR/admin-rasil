<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibroVenta;
use App\Models\Quincena;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class LibroVentaController extends Controller
{
    public function index()
    {
        $quincenas = Quincena::all();
        return view('libro_venta.index',['quincenas' => $quincenas]);
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

    public function generarPdfVentas($quincenaId)
    {
        // Obtener la quincena seleccionada
        $quincena = Quincena::findOrFail($quincenaId);
    
        // Obtener todos los registros de ventas de la quincena seleccionada
        $ventas = LibroVenta::where('id_quincena', $quincenaId)->get();
    
        // Cálculos dinámicos
        $totalBaseImponible16 = $ventas->sum(function ($venta) {
            return $venta->base_impo_contribuyente + $venta->base_impo_no_contribuyente;
        });
        
        $debitoFiscal16 = $totalBaseImponible16 * 0.16;
    
        // Para esta implementación, el 12% y otros campos permanecen en 0
        $totalDebitosFiscales = $debitoFiscal16; // Para esta prueba, solo con el valor del 16%
        
        $retencionesAcumuladas = $ventas->sum('iva_retenido');
        $ivaRetenidoComprador = 0; // Este valor será 0 por defecto
        $totalRetenciones = $retencionesAcumuladas + $ivaRetenidoComprador;
    
        // Preparar los datos para la vista, incluyendo la quincena
        $data = [
            'quincenaDescripcion' => $quincena->descripcion,
            'fechaInicio' => $quincena->fecha_inicio,
            'fechaFin' => $quincena->fecha_final,
            'totalBaseImponible16' => $totalBaseImponible16,
            'debitoFiscal16' => $debitoFiscal16,
            'totalDebitosFiscales' => $totalDebitosFiscales,
            'retencionesAcumuladas' => $retencionesAcumuladas,
            'ivaRetenidoComprador' => $ivaRetenidoComprador,
            'totalRetenciones' => $totalRetenciones,
        ];
    
        $pdf = PDF::loadView('libro_venta.resumen_quincena_pdf', $data);
        return $pdf->download('RESUMEN_QUINCENA_VENTAS'. ' '. $quincena->descripcion.$quincena->fecha_inicio.' '.$quincena->fecha_final.'.pdf');
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

        return response()->json([
            'success' => true,
            'redirect_url' => route('ventas.index'), // URL para redirigir
        ]);
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
