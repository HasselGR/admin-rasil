<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominaEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::create('nomina_empleados', function (Blueprint $table) {
            $table->id('id_empleado'); // Asegúrate de usar 'id_empleado' aquí
            $table->string('nombre_empleado');
            $table->string('cedula_identidad')->unique();
            $table->bigInteger('cod_contrato');
            $table->float('salario_gobierno');
            $table->float('salario_empresa');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nomina_empleados');
    }
}