<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientesCargamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredientes_cargamentos', function (Blueprint $table) {
            $table->id('id_detalle_cargamento');
            $table->foreignId('id_cargamento')->constrained('cargamentos', 'id_cargamento')->onDelete('cascade'); // Refiriendo la columna id_cargamento
            $table->foreignId('id_ingrediente')->constrained('ingredientes', 'id_ingrediente')->onDelete('cascade'); // Refiriendo la columna id_ingrediente
            $table->string('nombre_ingrediente');
            $table->float('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredientes_cargamentos');
    }
}
