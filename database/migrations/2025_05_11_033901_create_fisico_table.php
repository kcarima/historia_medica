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
        Schema::create('fisico', function (Blueprint $table) {
            $table->id();

            $table->string('presion_arterial')->nullable();
            $table->unsignedInteger('frecuencia_cardiaca')->nullable();
            $table->unsignedInteger('frecuencia_respiratoria')->nullable();
            $table->decimal('temperatura', 4, 1)->nullable(); // Ejemplo: 36.5
            $table->unsignedInteger('saturacion_oxigeno')->nullable();
            $table->decimal('peso', 6, 2)->nullable(); // Ejemplo: 70.25 kg
            $table->decimal('talla', 5, 1)->nullable(); // Ejemplo: 175.5 cm

            $table->text('examen_general')->nullable();
            $table->text('examen_por_sistemas')->nullable();
            $table->string('historia',null);
             $table->foreign('historia')->references('historia')->on('pacientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fisico');
    }
};
