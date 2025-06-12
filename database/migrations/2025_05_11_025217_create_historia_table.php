<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriasTable extends Migration
{
    public function up()
    {
        Schema::create('historias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->dateTime('fecha_atencion');
            $table->string('motivo_consulta', 1000);
            $table->string('diagnostico', 255)->nullable();
            $table->text('plan_tratamiento')->nullable();
            $table->text('tratamiento_farmacologico')->nullable();
            $table->text('ordenes_examenes')->nullable();
            $table->text('evolucion')->nullable();
            $table->text('interconsultas')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('historias');
    }
}
