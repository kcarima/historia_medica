<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgresosTable extends Migration
{
    public function up()
    {
        Schema::create('egresos', function (Blueprint $table) {
            $table->id();
            $table->string('historia');
            $table->text('diagnostico_egreso')->nullable();
            $table->text('recomendaciones_seguimiento')->nullable();
            $table->timestamps();
            $table->index('historia');
        });
    }

    public function down()
    {
        Schema::dropIfExists('egresos');
    }
}
