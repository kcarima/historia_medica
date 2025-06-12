<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagenologiasTable extends Migration
{
    public function up()
    {
        Schema::create('imagenologias', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('ruta');
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagenologias');
    }
}
