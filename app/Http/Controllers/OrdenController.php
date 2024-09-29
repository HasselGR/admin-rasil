<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingrediente;
use App\Models\Orden;
use App\Models\MedidasPlato;
use App\Models\OrdenDetalle;
use App\Models\Plato;
use Illuminate\Support\Facades\DB;


class OrdenController extends Controller
{
    public function index()
    {
        $ordenes = Orden::all();
        return view('orden.index', compact('ordenes'));
    }

    public function create()
    {
        $platos = Plato::all();
        return view('orden.create', compact('platos'));
    }
    

    public function store(Request $request)
{
  
        // Crear la orden
        $orden = new Orden();
        $orden->fecha = $request->input('fecha');
        $orden->hora = $request->input('hora');
        $orden->save();
        $inventarioExcedido = false;


        // Iterar sobre los platos seleccionados y crear detalles de la orden
        foreach ($request->plato_id as $index => $platoId) {
            $platoModel = Plato::find($platoId);

            if (!$platoModel) {
                throw new \Exception('Plato no encontrado');
            }

            $detalle = new OrdenDetalle();
            $detalle->id_orden = $orden->id_orden;
            $detalle->id_plato = $platoModel->id_plato;
            $detalle->nombre_plato = $platoModel->nombre_plato;
            $detalle->cantidad = $request->cantidad[$index];
            $detalle->precio_unitario = $platoModel->costo;
            $detalle->total = $platoModel->costo * $request->cantidad[$index];
            $detalle->save();


            // Verificar inventario y lanzar excepción si hay algún problema
            $ingredientes = MedidasPlato::where('id_plato', $platoId)->get();
            foreach ($ingredientes as $ingrediente) {
                $ingredienteBase = Ingrediente::find($ingrediente->id_ingrediente);
                $cantidadNecesaria = $ingrediente->cantidad * $request->cantidad[$index];

                if ($ingredienteBase->cantidad < $cantidadNecesaria) {
                    $inventarioExcedido = true;
                }

                // Actualizar la cantidad de ingredientes en inventario
                $ingredienteBase->cantidad -= $cantidadNecesaria;
                $ingredienteBase->save();
            }
        }

        // Actualizar el total de la orden
   
        $orden->save();

        
        if($inventarioExcedido == false){
            return response()->json([
                'status' => 'success',
                'message' => 'Orden creada exitosamente',
            ]);

        }else{
            return response()->json([
                'status' => 'success',
                'message' => 'Platillo excedido de inventario, revisar.',
            ]);

        }
    
}
    
    
    
    


    public function show($id)
    {
        $orden = Orden::with('detalles')->findOrFail($id); // Obtenemos la orden y sus detalles
    
        return view('orden.show', compact('orden'));
    }
    

    public function edit($id)
    {
        $orden = Orden::findOrFail($id);
        return view('orden.edit', compact('orden'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            // Agrega más validaciones según sea necesario
        ]);

        $orden = Orden::findOrFail($id);
        $orden->update($request->all());

        return redirect()->route('orden.index')->with('success', 'Orden actualizada con éxito');
    }

    public function destroy($id)
    {
        $orden = Orden::findOrFail($id);
        $orden->delete();

        return redirect()->route('orden.index')->with('success', 'Orden eliminada con éxito');
    }
}
