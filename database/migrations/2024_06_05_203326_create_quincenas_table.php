<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuincenasTable extends Migration
{
    public function up()
    {
        Schema::create('quincenas', function (Blueprint $table) {
            $table->bigIncrements('id_quincena'); // Definimos la columna id_quincena
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->string('descripcion', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quincenas');
    }
}