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
        Schema::create('reporte_enfermerias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('enfermera_id');
            $table->unsignedBigInteger('historia_id');
            $table->string('historia'); // Campo para guardar el número real de historia
            $table->date('fecha');
            $table->text('reporte');
            $table->timestamps();

            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->foreign('enfermera_id')->references('id')->on('users');
            $table->foreign('historia_id')->references('id')->on('historias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte_enfermerias');
    }
};
