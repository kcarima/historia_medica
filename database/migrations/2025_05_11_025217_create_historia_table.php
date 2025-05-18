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
        Schema::create('historia', function (Blueprint $table) {
            $table->id();
            $table->string('historia',10);
            $table->dateTime('fecha_atencion'); // Fecha y hora de la atención
            $table->text('motivo_consulta');    // Motivo de la consulta
            $table->timestamps();
            $table->softDeletes();              // Para borrado lógico si lo deseas
            $table->foreign('historia')->references('historia')->on('pacientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historia');
    }
};
