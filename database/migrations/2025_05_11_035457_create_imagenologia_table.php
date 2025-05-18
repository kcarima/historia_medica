<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('imagenologia', function (Blueprint $table) {
            $table->id();

            // Tipo de resultado: radiografia, tomografia, resonancia, ecografia, otros
            $table->enum('tipo_resultado', ['radiografia', 'tomografia', 'resonancia', 'ecografia', 'otros']);

            // Ruta o nombre del archivo de la imagen
            $table->string('ruta_imagen');
            $table->foreign('historia')->references('historia')->on('pacientes');
            $table->timestamps();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenologia');
    }
};
