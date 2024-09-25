<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasPorCobrarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas_por_cobrar', function (Blueprint $table) {
            $table->id('id_cuenta'); // ID primario autoincremental
            $table->string('id_factura')->unique(); // ID de la factura, debe ser único
            $table->unsignedBigInteger('id_cliente'); // FK para la relación con el cliente
            $table->string('nombre_cliente'); // Nombre del cliente
            $table->date('fecha_emision'); // Fecha de emisión de la factura
            $table->date('fecha_vencimiento'); // Fecha de vencimiento
            $table->float('monto_con_iva'); // Monto total con IVA
            $table->boolean('estado')->default(false); // Estado de la factura, default como pendiente
            $table->date('fecha_pago')->nullable(); // Fecha de pago (nullable porque puede ser no pagada aún)
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes_renta')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentas_por_cobrar');
    }
}
