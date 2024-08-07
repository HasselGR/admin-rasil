<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedidasPlatosTable extends Migration
{
    public function up()
    {
        Schema::create('medidas_platos', function (Blueprint $table) {
            $table->id('id_medida_plato');
            $table->unsignedBigInteger('id_plato');
            $table->string('nombre_plato');
            $table->unsignedBigInteger('id_ingrediente');
            $table->string('nombre_ingrediente');
            $table->unsignedBigInteger('unidad_medida');
            $table->string('nombre_unidad');
            $table->timestamps();

            $table->foreign('id_plato')->references('id_plato')->on('plato')->onDelete('cascade');
            $table->foreign('id_ingrediente')->references('id_ingrediente')->on('ingredientes')->onDelete('cascade');
            $table->foreign('unidad_medida')->references('id_unidad_medida')->on('unidad_medida')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('medidas_platos');
    }
}
