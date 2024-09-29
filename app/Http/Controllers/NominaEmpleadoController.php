<?php

namespace App\Http\Controllers;

use App\Models\NominaEmpleado;
use App\Models\AsignacionEmpleado;
use App\Models\DeduccionEmpleado;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class NominaEmpleadoController extends Controller
{
    public function index()
    {
        $nominaEmpleados = NominaEmpleado::all();
        return view('nomina_empleados.index', compact('nominaEmpleados'));
    }

    public function getEmpleados(Request $request)
    {
        if ($request->ajax()) {
            $empleados = NominaEmpleado::select([
                'id_empleado',
                'nombre_empleado',
                'cedula_identidad',
                'cod_contrato',
                'salario_gobierno',
                'salario_empresa'
            ]);
            
            return DataTables::of($empleados)
                ->addColumn('acciones', function ($empleado) {
                    return '
                        <a class="btn btn-info" href="'.route('nomina-empleados.show', $empleado->id_empleado).'">Mostrar</a>
                        <a class="btn btn-primary" href="'.route('nomina-empleados.edit', $empleado->id_empleado).'">Editar</a>
                        <a class="btn btn-warning" href="'.route('nomina-empleados.horas', $empleado->id_empleado).'">Ver Asignaciones y Deducciones</a>
                        <form action="'.route('nomina-empleados.destroy', $empleado->id_empleado).'" method="POST" style="display:inline-block;">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>';
                })
                ->rawColumns(['acciones'])
                
                ->make(true);
        }

        return abort(404);
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
        return response()->json([
            'success' => true,
            'redirect_url' => route(name: 'nomina-empleados.index'), // URL para redirigir
        ]);
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
        return response()->json([
            'success' => true,
            'redirect_url' => route(name: 'nomina-empleados.index'), // URL para redirigir
        ]);
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
