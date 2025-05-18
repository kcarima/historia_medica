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
        Schema::create('antecedetes', function (Blueprint $table) {
            $table->id();
            // Fisiológicos
            $table->text('desarrollo_psicomotor')->nullable();
            $table->text('alimentacion')->nullable();
            $table->text('sueno')->nullable();
            $table->text('eliminacion')->nullable();
            $table->text('vacunacion')->nullable();
            $table->text('alergias')->nullable();
            $table->text('habitos')->nullable();

            // Patológicos
            $table->text('enfermedades_previas')->nullable();
            $table->text('cirugias')->nullable();
            $table->text('hospitalizaciones')->nullable();
            $table->text('traumatismos')->nullable();
            $table->text('congenitas_perinatales')->nullable();

            $table->timestamps();
             $table->string('historia',null);
             $table->foreign('historia')->references('historia')->on('pacientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedetes');
    }
};
