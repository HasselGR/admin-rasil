<?php


namespace App\Http\Controllers;

use App\Models\AsignacionEmpleado;
use App\Models\DeduccionEmpleado;
use App\Models\NominaEmpleado;
use Illuminate\Http\Request;

class AsignacionEmpleadoController extends Controller
{
    public function index()
    {
        $asignaciones = AsignacionEmpleado::with('empleado')->get();
        return view('asignaciones_empleados.index', compact('asignaciones'));
    }

    public function create()
    {
        $empleados = NominaEmpleado::all();
        return view('asignaciones_empleados.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_empleado' => 'required|exists:nomina_empleados,id_empleado',
            'id_quincena' => 'required|exists:quincenas,id_quincena',
            'dias_trabajados' => 'required|integer',
            'dias_descanso' => 'required|integer',
            'horas_extra_diurnas' => 'required|integer',
            'horas_extra_nocturnas' => 'required|integer',
            'bono_nocturno' => 'required|integer',
            'clt' => 'required|integer',
            'dia_feriado_trabajado' => 'required|integer',
            'total_devengado' => 'required|numeric',
            's_s_o' => 'required|numeric',
            'paro_forzoso' => 'required|numeric',
            'ley_politica_habit' => 'required|numeric',
            'sindicato' => 'required|numeric',
            'descuento_faltas' => 'required|numeric',
            'descuento_prestamos' => 'required|numeric',
            'total_deducciones' => 'required|numeric',
        ]);

        AsignacionEmpleado::create($request->all());
        DeduccionEmpleado::create($request->all());
    
        return redirect()->route('nomina-empleados.index')->with('success', 'Asignación creada con éxito');
    }

    public function edit(AsignacionEmpleado $asignacionEmpleado)
    {
        $empleados = NominaEmpleado::all();
        return view('asignaciones_empleados.edit', compact('asignacionEmpleado', 'empleados'));
    }

    public function update(Request $request, AsignacionEmpleado $asignacionEmpleado)
    {
        $request->validate([
            'id_empleado' => 'required|exists:nomina_empleados,id_empleado',
            'dias_trabajados' => 'required|integer',
            'dias_descanso' => 'required|integer',
            'horas_extra_diurnas' => 'required|integer',
            'horas_extra_nocturnas' => 'required|integer',
            'bono_nocturno' => 'required|integer',
            'clt' => 'required|integer',
            'dia_feriado_trabajado' => 'required|integer',
            'total_devengado' => 'required|numeric',
        ]);

        $asignacionEmpleado->update($request->all());
        return redirect()->route('asignaciones_empleados.index')->with('success', 'Asignación actualizada con éxito');
    }

    public function destroy(AsignacionEmpleado $asignacionEmpleado)
    {
        $asignacionEmpleado->delete();
        return redirect()->route('asignaciones_empleados.index')->with('success', 'Asignación eliminada con éxito');
    }
}
