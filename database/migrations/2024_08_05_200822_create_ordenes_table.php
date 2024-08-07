<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesTable extends Migration
{
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id('id_orden');
            $table->unsignedBigInteger('id_plato');
            $table->string('nombre_plato');
            $table->date('fecha');
            $table->time('hora');
            $table->unsignedBigInteger('id_factura');
            $table->timestamps();

            $table->foreign('id_plato')->references('id_plato')->on('plato')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordenes');
    }
}
