<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionesEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::create('asignaciones_empleados', function (Blueprint $table) {
            $table->id('id_asignaciones');
            $table->foreignId('id_empleado')->constrained('nomina_empleados', 'id_empleado'); // Referencia a 'id_empleado'
            $table->unsignedBigInteger('id_quincena'); // Agregar la columna id_quincena
            $table->integer('dias_trabajados');
            $table->integer('dias_descanso');
            $table->integer('horas_extra_diurnas');
            $table->integer('horas_extra_nocturnas');
            $table->integer('bono_nocturno');
            $table->integer('clt');
            $table->integer('dia_feriado_trabajado');
            $table->float('total_devengado');
            $table->timestamps();

            $table->foreign('id_quincena')->references('id_quincena')->on('quincenas')->onDelete('cascade'); // Agregar la relación de clave foránea
        });
    }

    public function down()
    {
        Schema::dropIfExists('asignaciones_empleados');
    }
}
