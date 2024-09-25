<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDebeFromRentaLocales extends Migration
{
    public function up()
    {
        // Eliminar la columna "debe" de la tabla "renta_locales"
        Schema::table('renta_locales', function (Blueprint $table) {
            $table->dropColumn('debe');
        });
    }

    public function down()
    {
        // Revertir la eliminación, si es necesario
        Schema::table('renta_locales', function (Blueprint $table) {
            $table->float('debe')->default(0);
        });
    }
}
