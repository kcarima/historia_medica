<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudLaboratoriosTable extends Migration
{
    public function up()
    {
        Schema::create('solicitud_laboratorios', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->nullable();
            $table->string('nombre')->nullable();
            $table->string('edad')->nullable();
            $table->string('historia')->nullable();
            $table->string('fecha')->nullable();
            $table->text('examenes')->nullable();
            $table->text('otros')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitud_laboratorios');
    }
}
