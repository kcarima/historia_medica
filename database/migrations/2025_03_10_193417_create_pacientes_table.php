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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->enum('genero', ['Masculino', 'Femenino'])->default('Masculino');
            $table->string('primer_apellido', 50)->nullable();
            $table->string('segundo_apellido', 50)->nullable();
            $table->string('grupo_sanguineo', 5)->nullable();
            $table->string('nombre', 50);
            $table->string('estado_civil', 20)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('cedula', 15)->nullable();
            $table->string('correo_electronico', 100)->nullable();
            $table->string('telefono_local', 20)->nullable();
            $table->string('celular', 15)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->string('municipio', 50)->nullable();
            $table->string('parroquia', 50)->nullable();
            $table->string('historia', 10)->unique();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
