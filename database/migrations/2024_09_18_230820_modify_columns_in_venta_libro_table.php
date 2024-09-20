<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnsInVentaLibroTable extends Migration
{
    public function up()
    {
        Schema::table('venta_libro', function (Blueprint $table) {
            // Modificar las columnas para que sean nulas
            $table->date('fecha_comprobante_retencion')->nullable()->change();
            $table->integer('nro_comprobante')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('venta_libro', function (Blueprint $table) {
            // Revertir los cambios
            $table->date('fecha_comprobante_retencion')->nullable(false)->change();
            $table->integer('nro_comprobante')->nullable(false)->change();
        });
    }
}
