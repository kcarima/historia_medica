<?php
// database/migrations/2025_05_30_000001_create_nota_operatorias_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaOperatoriasTable extends Migration
{
    public function up()
    {
        Schema::create('nota_operatorias', function (Blueprint $table) {
            $table->id();
            $table->string('historia'); // Número de historia clínica
            $table->text('nota');       // Texto de la nota operatoria
            $table->timestamps();

            // Índice para optimizar búsquedas por historia
            $table->index('historia');
        });
    }

    public function down()
    {
        Schema::dropIfExists('nota_operatorias');
    }
}
