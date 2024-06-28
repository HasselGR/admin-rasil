<?php

// database/migrations/xxxx_xx_xx_create_renta_locales_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentaLocalesTable extends Migration
{
    public function up()
    {
        Schema::create('renta_locales', function (Blueprint $table) {
            $table->id('id_renta');
            $table->foreignId('id_local')->constrained('local_renta', 'id_local'); // Referencia a 'id_local'
            $table->foreignId('id_cliente')->constrained('clientes_renta', 'id_cliente'); // Referencia a 'id_cliente'
            $table->date('fecha');
            $table->string('concepto');
            $table->string('forma_pago');
            $table->float('debe');
            $table->float('haber');
            $table->float('retencion_iva');
            $table->float('retencion_isrf');
            $table->float('saldo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('renta_locales');
    }
}