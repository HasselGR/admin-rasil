<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NominaEmpleadoController;
use App\Http\Controllers\AsignacionEmpleadoController;
use App\Http\Controllers\DeduccionEmpleadoController;
use App\Http\Controllers\QuincenaController;   

Route::get('/', function () {
    return view('main_page.mainpage');
});


Route::get('/main', [MainController::class, 'index']);

// Ruta para la página de creación de asignaciones y deducciones
Route::get('/nomina-empleados/asignar-horas', [NominaEmpleadoController::class, 'createHoras'])->name('nomina-empleados.create-horas');
Route::get('nomina-empleados/data', [NominaEmpleadoController::class, 'getEmpleados'])->name('nomina_empleados.data');


Route::resource('nomina-empleados', NominaEmpleadoController::class);



Route::resource('asignaciones-empleados', AsignacionEmpleadoController::class);
Route::resource('deducciones-empleados', DeduccionEmpleadoController::class);

//Tabla de empleados





// Nueva ruta para ver asignaciones y deducciones
Route::get('/nomina-empleados/{nomina_empleado}/horas', [NominaEmpleadoController::class, 'showAsignacionesDeducciones'])->name('nomina-empleados.horas');


//
Route::post('/quincenas', [QuincenaController::class, 'store'])->name('quincenas.store');
Route::get('/quincenas', [QuincenaController::class, 'index'])->name('quincenas.index');


// Ruta para almacenar asignaciones
Route::post('/asignaciones-empleados/store', [AsignacionEmpleadoController::class, 'store'])->name('asignaciones-empleados.store');

// Ruta para almacenar deducciones
Route::post('/deducciones-empleados/store', [DeduccionEmpleadoController::class, 'store'])->name('deducciones-empleados.store');