<?php

// database/migrations/xxxx_xx_xx_add_nombre_local_to_local_renta_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNombreLocalToLocalRentaTable extends Migration
{
    public function up()
    {
        Schema::table('local_renta', function (Blueprint $table) {
            $table->string('nombre_local')->after('id_local'); // Añadir el campo después de 'id_local'
        });
    }

    public function down()
    {
        Schema::table('local_renta', function (Blueprint $table) {
            $table->dropColumn('nombre_local'); // Eliminar el campo si se deshace la migración
        });
    }
}

