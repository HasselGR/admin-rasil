<?php

// database/migrations/xxxx_xx_xx_create_local_renta_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalRentaTable extends Migration
{
    public function up()
    {
        Schema::create('local_renta', function (Blueprint $table) {
            $table->id('id_local'); // Usamos 'id_local' en lugar de 'id'
            $table->string('ubicacion');
            $table->float('canon');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('local_renta');
    }
}
