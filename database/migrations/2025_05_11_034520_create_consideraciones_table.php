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
        Schema::create('consideraciones', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_representante')->nullable();
            $table->string('identificacion_representante')->nullable();
            $table->string('relacion_representante')->nullable();

            $table->text('desarrollo_psicomotor_nino')->nullable();
            $table->text('esquema_vacunacion')->nullable();
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
        Schema::dropIfExists('consideraciones');
    }
};
