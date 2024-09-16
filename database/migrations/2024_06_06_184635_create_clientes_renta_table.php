<?php

// database/migrations/xxxx_xx_xx_create_clientes_renta_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesRentaTable extends Migration
{
    public function up()
    {
        Schema::create('clientes_renta', function (Blueprint $table) {
            $table->id('id_cliente'); // Usamos 'id_cliente' en lugar de 'id'
            $table->string('nombre_razon_social');
            $table->string('rif');
            $table->string('telefono');
            $table->string('correo')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes_renta');
    }
}