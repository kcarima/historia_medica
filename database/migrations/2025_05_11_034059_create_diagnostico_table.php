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
        Schema::create('diagnostico', function (Blueprint $table) {
            $table->id();

            $table->string('diagnostico')->nullable(); // Diagnóstico (CIE-10)
            $table->date('fecha_diagnostico')->nullable(); // Fecha del Diagnóstico

            $table->text('plan_tratamiento')->nullable(); // Plan de Tratamiento e Indicaciones
            $table->text('tratamiento_farmacologico')->nullable(); // Tratamiento Farmacológico
            $table->text('ordenes_examenes')->nullable(); // Órdenes de Exámenes Complementarios

            $table->text('evolucion')->nullable(); // Evolución Clínica
            $table->text('interconsultas')->nullable(); // Interconsultas Realizadas
            $table->text('observaciones')->nullable(); // Observaciones Adicionales
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
        Schema::dropIfExists('diagnostico');
    }
};
