<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadMedidaTable extends Migration
{
    public function up()
    {
        Schema::create('unidad_medida', function (Blueprint $table) {
            $table->id('id_unidad_medida');
            $table->string('nombre_unidad');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('unidad_medida');
    }
}
