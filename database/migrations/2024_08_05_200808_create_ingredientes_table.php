<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientesTable extends Migration
{
    public function up()
    {
        Schema::create('ingredientes', function (Blueprint $table) {
            $table->id('id_ingrediente');
            $table->string('nombre_ingrediente');
            $table->float('cantidad');
            $table->unsignedBigInteger('unidad_medida');
            $table->timestamps();

            $table->foreign('unidad_medida')->references('id_unidad_medida')->on('unidad_medida')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ingredientes');
    }
}
