<?php

namespace App\Http\Controllers;

use App\Models\Cargamento;
use App\Models\Ingrediente;
use App\Models\IngredienteCargamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CargamentosController extends Controller
{
    // Mostrar la lista de cargamentos
    public function index()
    {
        $cargamentos = Cargamento::all();
        return view('cargamentos.index', compact('cargamentos'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        $ingredientes = Ingrediente::all(); // Traer los ingredientes para usarlos en el formulario
        return view('cargamentos.create', compact('ingredientes'));
    }

    // Guardar un nuevo cargamento
    public function store(Request $request)
    {
        // Crear el cargamento (cabecera)
        $cargamento = new Cargamento();
        $cargamento->fecha = $request->input('fecha');
        $cargamento->nro_factura = $request->input('nro_factura');
        $cargamento->save();
    
        // Iterar sobre los ingredientes seleccionados y crear detalles del cargamento
        foreach ($request->ingrediente_id as $index => $ingredienteId) {
            $ingredienteModel = Ingrediente::find($ingredienteId);
    
            if (!$ingredienteModel) {
                throw new \Exception('Ingrediente no encontrado');
            }
    
            // Crear la fila de detalle (ingredientes_cargamentos)
            $detalle = new IngredienteCargamento();
            $detalle->id_cargamento = $cargamento->id_cargamento;
            $detalle->id_ingrediente = $ingredienteModel->id_ingrediente;
            $detalle->nombre_ingrediente = $ingredienteModel->nombre_ingrediente;
            $detalle->cantidad = $request->cantidad[$index];
            $detalle->save();
    
            // Actualizar el stock del ingrediente (sumar la cantidad recibida)
            $ingredienteModel->cantidad += $request->cantidad[$index];
            $ingredienteModel->save();
        }
    
        return redirect()->route('cargamentos.index')->with('success', 'Cargamento creado con éxito');
    }

    // Mostrar un cargamento específico
    public function show($id)
    {
        $cargamento = Cargamento::find($id);
        return view('cargamentos.show', compact('cargamento'));
    }

    // Eliminar un cargamento
    public function destroy($id)
    {
        $cargamento = Cargamento::find($id);
        $cargamento->delete();

        return redirect()->route('cargamentos.index')->with('success', 'Cargamento eliminado exitosamente');
    }
}
