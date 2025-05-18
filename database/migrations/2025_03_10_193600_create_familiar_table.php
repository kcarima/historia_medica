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
        Schema::create('familiar', function (Blueprint $table) {
            $table->id();

            // Enfermedades de los padres almacenadas como texto (JSON o texto plano)
            $table->json('enfermedades_padres')->nullable();

            // Otra enfermedad especificada
            $table->string('otra_enfermedad_padres')->nullable();

            // ¿Algún hermano presenta enfermedades hereditarias?
            $table->enum('hermanos', ['Sí', 'No'])->default('No');

            // Detalle si aplica
            $table->string('detalle_hermanos')->nullable();

            // Observaciones adicionales
            $table->text('observaciones')->nullable();
            $table->string('historia',null);
             $table->foreign('historia')->references('historia')->on('pacientes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('familiar');
    }
};
