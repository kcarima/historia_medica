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
        Schema::create('anamnesis', function (Blueprint $table) {
            $table->id();
            $table->string('historia',10);
            $table->text('enfermedad_actual')->nullable(); // Descripción de la enfermedad actual
            $table->foreign('historia')->references('historia')->on('pacientes');
            $table->timestamps();
            $table->softDeletes(); // Para borrado lógico (opcional)

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anamnesis');
    }
};
