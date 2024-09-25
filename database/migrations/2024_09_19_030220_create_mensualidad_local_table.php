<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensualidadLocalTable extends Migration
{
    public function up()
    {
        Schema::create('mensualidad', function (Blueprint $table) {
            $table->id('id_mensualidad');
            $table->foreignId('id_local')->constrained('local_renta', 'id_local')->onDelete('cascade');
            $table->foreignId('id_cliente')->constrained('clientes_renta', 'id_cliente')->onDelete('cascade');
            $table->date('fecha');
            $table->float('debe'); // Referencia al canon del local
            $table->string('descripcion'); // Descripción de la mensualidad
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mensualidad');
    }
}
