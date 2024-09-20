<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNroFacturaAfectadaInCompraLibroTable extends Migration
{
    public function up()
    {
        Schema::table('compra_libro', function (Blueprint $table) {
            // Modificar la columna para que acepte valores nulos
            $table->integer('nro_factura_afectada')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('compra_libro', function (Blueprint $table) {
            // Revertir la columna a no nula
            $table->integer('nro_factura_afectada')->nullable(false)->change();
        });
    }
}
