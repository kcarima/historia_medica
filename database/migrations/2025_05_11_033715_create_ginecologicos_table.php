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
        Schema::create('ginecologicos', function (Blueprint $table) {
            $table->id();

            $table->string('menarquia')->nullable();
            $table->string('ciclo_menstrual')->nullable();
            $table->string('duracion_menstrual')->nullable();
            $table->string('dolor_menstrual')->nullable();

            $table->unsignedInteger('embarazos')->nullable();
            $table->unsignedInteger('partos')->nullable();
            $table->unsignedInteger('abortos')->nullable();
            $table->unsignedInteger('cesareas')->nullable();

            $table->string('metodo_anticonceptivo')->nullable();

            $table->date('fecha_ultima_menstruacion')->nullable();
            $table->date('fecha_ultimo_parto')->nullable();

            $table->string('complicaciones_embarazo')->nullable();
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
        Schema::dropIfExists('ginecologicos');
    }
};
