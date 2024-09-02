<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenDetalleTable extends Migration
{
    public function up()
    {
        Schema::create('orden_detalle', function (Blueprint $table) {
            $table->id('id_detalle');
            $table->unsignedBigInteger('id_orden');
            $table->unsignedBigInteger('id_plato');
            $table->string('nombre_plato');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 8, 2);
            $table->decimal('total', 8, 2);
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_orden')->references('id_orden')->on('orden')->onDelete('cascade');
            $table->foreign('id_plato')->references('id_plato')->on('plato');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orden_detalle');
    }
}
