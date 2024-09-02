<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenTable extends Migration
{
    public function up()
    {
        Schema::create('orden', function (Blueprint $table) {
            $table->id('id_orden');
            $table->date('fecha');
            $table->time('hora');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orden');
    }
}