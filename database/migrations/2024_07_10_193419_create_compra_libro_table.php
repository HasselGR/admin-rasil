<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraLibroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_libro', function (Blueprint $table) {
            $table->id('id_compra');
            $table->unsignedBigInteger('id_quincena');
            $table->date('fecha_factura');
            $table->string('nro_rif');
            $table->string('prov_razon_social');
            $table->integer('nro_factura');
            $table->integer('nro_control_factura');
            $table->string('tipo_transaccion');
            $table->integer('nro_factura_afectada');
            $table->float('total_compras');
            $table->float('compras_sin_derecho_iva');
            $table->float('descuento_tgif');
            $table->float('base_impo_contribuyente');
            $table->float('alicuota_contribuyente');
            $table->float('impuesto_iva_contribuyente');
            $table->float('base_impo_contribuyente_alic_red');
            $table->float('alicuota_contribuyente_alic_red');
            $table->float('impuesto_iva_contribuyente_alic_red');
            $table->float('iva_retenido');
            $table->integer('nro_comprobante');
            $table->date('fecha_comprobante_retencion');
            $table->timestamps();

            $table->foreign('id_quincena')->references('id_quincena')->on('quincenas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra_libro');
    }
}
