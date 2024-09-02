<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NominaEmpleadoController;
use App\Http\Controllers\AsignacionEmpleadoController;
use App\Http\Controllers\DeduccionEmpleadoController;
use App\Http\Controllers\QuincenaController;   
use App\Http\Controllers\LibroVentaController;
use App\Http\Controllers\LibroCompraController;
use App\Http\Controllers\IngredientesController;
use App\Http\Controllers\UnidadMedidaController;
use App\Http\Controllers\PlatoController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\MedidasPlatoController;
use App\Http\Controllers\OrdenDetalleController;


Route::get('/', function () {
    return view('main_page.mainpage');
});

Route::get('/ventas/create', [LibroVentaController::class, 'create'])->name('ventas.create');
Route::post('/ventas/store', [LibroVentaController::class, 'store'])->name('ventas.store');
Route::get('/ventas/index', [LibroVentaController::class, 'index'])->name('ventas.index');
Route::get('/ventas/data', [LibroVentaController::class, 'data'])->name('ventas.data');

Route::get('/compras/create', [LibroCompraController::class, 'create'])->name('compras.create');
Route::post('/compras/store', [LibroCompraController::class, 'store'])->name('compras.store');
Route::get('/compras/index', [LibroCompraController::class, 'index'])->name('compras.index');
Route::get('/compras/data', [LibroCompraController::class, 'data'])->name('compras.data');



Route::get('/main', [MainController::class, 'index'])->name('main.mainpage');

// Ruta para la página de creación de asignaciones y deducciones
Route::get('/nomina-empleados/asignar-horas', [NominaEmpleadoController::class, 'createHoras'])->name('nomina-empleados.create-horas');
Route::get('nomina-empleados/data', [NominaEmpleadoController::class, 'getEmpleados'])->name('nomina_empleados.data');


Route::resource('nomina-empleados', NominaEmpleadoController::class);



Route::resource('asignaciones-empleados', AsignacionEmpleadoController::class);
Route::resource('deducciones-empleados', DeduccionEmpleadoController::class);

//INGREDIENTES, PLATOS, ETCETERA

Route::resource('ingredientes', IngredientesController::class);
Route::resource('unidad_medida', UnidadMedidaController::class);
Route::resource('plato', PlatoController::class);

Route::resource('medidas_platos', MedidasPlatoController::class);
Route::resource('orden', OrdenController::class);
Route::resource('orden_detalle', OrdenDetalleController::class);
Route::get('/orden/{id}', [OrdenController::class, 'show'])->name('ordenes.show');






// Nueva ruta para ver asignaciones y deducciones
Route::get('/nomina-empleados/{nomina_empleado}/horas', [NominaEmpleadoController::class, 'showAsignacionesDeducciones'])->name('nomina-empleados.horas');


//
Route::post('/quincenas', [QuincenaController::class, 'store'])->name('quincenas.store');
Route::get('/quincenas', [QuincenaController::class, 'index'])->name('quincenas.index');


// Ruta para almacenar asignaciones
Route::post('/asignaciones-empleados/store', [AsignacionEmpleadoController::class, 'store'])->name('asignaciones-empleados.store');

// Ruta para almacenar deducciones
Route::post('/deducciones-empleados/store', [DeduccionEmpleadoController::class, 'store'])->name('deducciones-empleados.store');