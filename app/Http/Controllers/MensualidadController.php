<?php

namespace App\Http\Controllers;

use App\Models\Mensualidad;
use App\Models\LocalRenta;
use App\Models\ClienteRenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MensualidadController extends Controller
{
    /**
     * Muestra la lista de mensualidades.
     */
    public function index()
    {
        $mensualidades = Mensualidad::with(['local', 'cliente'])->get();
        return view('mensualidades.index', compact('mensualidades'));
    }

    /**
     * Muestra el formulario para crear una nueva mensualidad.
     */
    public function create()
    {
        $locales = LocalRenta::all();
        $clientes = ClienteRenta::all();
        return view('mensualidades.create', compact('locales', 'clientes'));
    }

    /**
     * Almacena una nueva mensualidad en la base de datos.
     */
    public function store(Request $request)
{
    // Validación de los campos
    $request->validate([
        'id_local' => 'required|exists:local_renta,id_local',
        'id_cliente' => 'required|exists:clientes_renta,id_cliente',
        'debe' => 'required|numeric',
        'descripcion' => 'required|string',
        'fecha' => 'required|date',
    ]);

    try {
        // Iniciar una transacción de base de datos
        DB::beginTransaction();

        // Crear la nueva mensualidad
        $mensualidad = Mensualidad::create([
            'id_local' => $request->id_local,
            'id_cliente' => $request->id_cliente,
            'debe' => $request->debe,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
        ]);

        // Obtener el cliente correspondiente para actualizar el saldo
        $cliente = ClienteRenta::find($request->id_cliente);

        if ($cliente) {
            // Sumar el valor de "debe" al saldo del cliente
            $cliente->saldo += $request->debe;
            $cliente->save();
        }

        // Confirmar la transacción
        DB::commit();

        return redirect()->route('mensualidades.index')->with('success', 'Mensualidad creada y saldo actualizado correctamente');
    } catch (\Exception $e) {
        // Si ocurre algún error, deshacer la transacción
        DB::rollBack();
        return redirect()->back()->with('error', 'Error al crear la mensualidad: ' . $e->getMessage());
    }
}


    /**
     * Muestra el formulario para editar una mensualidad existente.
     */
    public function edit($id)
    {
        $mensualidad = Mensualidad::findOrFail($id);
        $locales = LocalRenta::all();
        $clientes = ClienteRenta::all();
        return view('mensualidades.edit', compact('mensualidad', 'locales', 'clientes'));
    }

    /**
     * Actualiza una mensualidad en la base de datos.
     */
    public function update(Request $request, Mensualidad $mensualidad)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_local' => 'required|exists:local_renta,id_local',
            'id_cliente' => 'required|exists:clientes_renta,id_cliente',
            'debe' => 'required|numeric',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
        ]);
    
        try {
            // Iniciar una transacción de base de datos
            DB::beginTransaction();
    
            // Obtener el cliente anterior para ajustar su saldo
            $clienteAnterior = ClienteRenta::find($mensualidad->id_cliente);
    
            // Restar el valor anterior del debe al saldo del cliente
            if ($clienteAnterior) {
                $clienteAnterior->saldo -= $mensualidad->debe;
                $clienteAnterior->save();
            }
    
            // Actualizar la mensualidad con los nuevos datos
            $mensualidad->update([
                'id_local' => $request->id_local,
                'id_cliente' => $request->id_cliente,
                'debe' => $request->debe,
                'descripcion' => $request->descripcion,
                'fecha' => $request->fecha,
            ]);
    
            // Obtener el nuevo cliente para sumar el nuevo saldo
            $clienteNuevo = ClienteRenta::find($request->id_cliente);
    
            // Sumar el nuevo valor de "debe" al saldo del cliente
            if ($clienteNuevo) {
                $clienteNuevo->saldo += $request->debe;
                $clienteNuevo->save();
            }
    
            // Confirmar la transacción
            DB::commit();
    
            return redirect()->route('mensualidades.index')->with('success', 'Mensualidad actualizada y saldo del cliente ajustado correctamente');
        } catch (\Exception $e) {
            // Si ocurre algún error, deshacer la transacción
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar la mensualidad: ' . $e->getMessage());
        }
    }
    

    /**
     * Elimina una mensualidad de la base de datos.
     */
    public function destroy($id)
    {
        $mensualidad = Mensualidad::findOrFail($id);
        $mensualidad->delete();

        return redirect()->route('mensualidades.index')->with('success', 'Mensualidad eliminada con éxito');
    }
}
