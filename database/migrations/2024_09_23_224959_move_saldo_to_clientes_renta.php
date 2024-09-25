<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveSaldoToClientesRenta extends Migration
{
    public function up()
    {
        // Añadir el campo "saldo" a "clientes_renta"
        Schema::table('clientes_renta', function (Blueprint $table) {
            $table->float('saldo')->after('correo')->default(0); // Añadimos la columna con un valor predeterminado de 0
        });

        // Eliminar la columna "saldo" de "renta_locales"
        Schema::table('renta_locales', function (Blueprint $table) {
            $table->dropColumn('saldo');
        });
    }

    public function down()
    {
        // Revertir los cambios: añadir "saldo" de vuelta a "renta_locales"
        Schema::table('renta_locales', function (Blueprint $table) {
            $table->float('saldo')->default(0);
        });

        // Eliminar "saldo" de "clientes_renta"
        Schema::table('clientes_renta', function (Blueprint $table) {
            $table->dropColumn('saldo');
        });
    }
}