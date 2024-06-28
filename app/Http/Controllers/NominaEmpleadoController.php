<?php

namespace App\Http\Controllers;

use App\Models\NominaEmpleado;
use App\Models\AsignacionEmpleado;
use App\Models\DeduccionEmpleado;

use Illuminate\Http\Request;

class NominaEmpleadoController extends Controller
{
    public function index()
    {
        $nominaEmpleados = NominaEmpleado::all();
        return view('nomina_empleados.index', compact('nominaEmpleados'));
    }

    public function create()
    {
        return view('nomina_empleados.create');
    }

    public function createHoras()
    {
        $empleados = NominaEmpleado::all();
        return view('nomina_empleados.create_horas', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_empleado' => 'required',
            'cedula_identidad' => 'required|unique:nomina_empleados,cedula_identidad',
            'cod_contrato' => 'required',
            'salario_gobierno' => 'required|numeric',
            'salario_empresa' => 'required|numeric',
        ]);

        NominaEmpleado::create($request->all());
        return redirect()->route('nomina-empleados.index')->with('success', 'Empleado creado con éxito');
    }

    public function show(NominaEmpleado $nominaEmpleado)
    {
        return view('nomina_empleados.show', compact('nominaEmpleado'));
    }

    public function edit(NominaEmpleado $nominaEmpleado)
    {
        return view('nomina_empleados.edit', compact('nominaEmpleado'));
    }

    public function update(Request $request, NominaEmpleado $nominaEmpleado)
    {
        $request->validate([
            'nombre_empleado' => 'required',
            'cedula_identidad' => 'required|unique:nomina_empleados,cedula_identidad,' . $nominaEmpleado->id_empleado . ',id_empleado',
            'cod_contrato' => 'required',
            'salario_gobierno' => 'required|numeric',
            'salario_empresa' => 'required|numeric',
        ]);

        $nominaEmpleado->update($request->all());
        return redirect()->route('nomina-empleados.index')->with('success', 'Empleado actualizado con éxito');
    }

    public function destroy(NominaEmpleado $nominaEmpleado)
    {
        $nominaEmpleado->delete();
        return redirect()->route('nomina-empleados.index')->with('success', 'Empleado eliminado con éxito');
    }

    public function showAsignacionesDeducciones($id_empleado)
    {
        $nominaEmpleado = NominaEmpleado::find($id_empleado);

        if (!$nominaEmpleado) {
            return redirect()->route('nomina-empleados.index')->with('error', 'Empleado no encontrado');
        }

        $asignaciones = AsignacionEmpleado::where('id_empleado', $id_empleado)->get();
        $deducciones = DeduccionEmpleado::where('id_empleado', $id_empleado)->get();

        return view('nomina_empleados.horas', compact('nominaEmpleado', 'asignaciones', 'deducciones'));
    }
}
