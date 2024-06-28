<?php

// database/migrations/xxxx_xx_xx_create_deducciones_empleados_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeduccionesEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::create('deducciones_empleados', function (Blueprint $table) {
            $table->id('id_deduccion');
            $table->foreignId('id_empleado')->constrained('nomina_empleados', 'id_empleado'); // Referencia a 'id_empleado'
            $table->float('s_s_o');
            $table->float('paro_forzoso');
            $table->float('ley_politica_habit');
            $table->float('sindicato');
            $table->float('descuento_faltas');
            $table->float('descuento_prestamos');
            $table->float('total_deducciones');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deducciones_empleados');
    }
}
