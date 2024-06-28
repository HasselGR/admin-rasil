<?php
namespace App\Http\Controllers;

use App\Models\DeduccionEmpleado;
use App\Models\NominaEmpleado;
use Illuminate\Http\Request;

class DeduccionEmpleadoController extends Controller
{
    public function index()
    {
        $deducciones = DeduccionEmpleado::with('empleado')->get();
        return view('deducciones_empleados.index', compact('deducciones'));
    }

    public function create()
    {
        $empleados = NominaEmpleado::all();
        return view('deducciones_empleados.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_empleado' => 'required|exists:nomina_empleados,id_empleado',
            's_s_o' => 'required|numeric',
            'paro_forzoso' => 'required|numeric',
            'ley_politica_habit' => 'required|numeric',
            'sindicato' => 'required|numeric',
            'descuento_faltas' => 'required|numeric',
            'descuento_prestamos' => 'required|numeric',
            'total_deducciones' => 'required|numeric',
        ]);

        DeduccionEmpleado::create($request->all());
        return redirect()->route('deducciones_empleados.index')->with('success', 'Deducción creada con éxito');
    }

    public function edit(DeduccionEmpleado $deduccionEmpleado)
    {
        $empleados = NominaEmpleado::all();
        return view('deducciones_empleados.edit', compact('deduccionEmpleado', 'empleados'));
    }

    public function update(Request $request, DeduccionEmpleado $deduccionEmpleado)
    {
        $request->validate([
            'id_empleado' => 'required|exists:nomina_empleados,id_empleado',
            's_s_o' => 'required|numeric',
            'paro_forzoso' => 'required|numeric',
            'ley_politica_habit' => 'required|numeric',
            'sindicato' => 'required|numeric',
            'descuento_faltas' => 'required|numeric',
            'descuento_prestamos' => 'required|numeric',
            'total_deducciones' => 'required|numeric',
        ]);

        $deduccionEmpleado->update($request->all());
        return redirect()->route('deducciones_empleados.index')->with('success', 'Deducción actualizada con éxito');
    }

    public function destroy(DeduccionEmpleado $deduccionEmpleado)
    {
        $deduccionEmpleado->delete();
        return redirect()->route('deducciones_empleados.index')->with('success', 'Deducción eliminada con éxito');
    }
}
