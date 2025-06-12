<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('anamnesis', function (Blueprint $table) {
            $table->id();
            $table->string('historia');

            // Enfermedad actual
            $table->text('enfermedad_actual')->nullable();

            // Antecedentes personales fisiológicos
            $table->text('desarrollo_psicomotor')->nullable();
            $table->text('alimentacion')->nullable();
            $table->text('sueno')->nullable();
            $table->text('eliminacion')->nullable();
            $table->text('vacunacion')->nullable();
            $table->text('alergias')->nullable();
            $table->text('habitos')->nullable();

            // Antecedentes personales patológicos
            $table->text('enfermedades_previas')->nullable();
            $table->text('cirugias')->nullable();
            $table->text('hospitalizaciones')->nullable();
            $table->text('traumatismos')->nullable();
            $table->text('congénitas_perinatales')->nullable();

            // Antecedentes familiares
            $table->json('enfermedades_padres')->nullable();
            $table->string('otra_enfermedad_padres')->nullable();
            $table->string('hermanos')->nullable();
            $table->string('detalle_hermanos')->nullable();
            $table->text('observaciones')->nullable();

            // Antecedentes ginecológicos
            $table->string('menarquia')->nullable();
            $table->string('ciclo_menstrual')->nullable();
            $table->string('duracion_menstrual')->nullable();
            $table->string('dolor_menstrual')->nullable();
            $table->integer('embarazos')->nullable();
            $table->integer('partos')->nullable();
            $table->integer('abortos')->nullable();
            $table->integer('cesareas')->nullable();
            $table->string('metodo_anticonceptivo')->nullable();
            $table->date('fecha_ultima_menstruacion')->nullable();
            $table->date('fecha_ultimo_parto')->nullable();
            $table->string('complicaciones_embarazo')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anamnesis');
    }
};
