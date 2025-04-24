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
        Schema::create('familiar', function (Blueprint $table) {
            $table->id();
            $table->string("nombre_razon");
            $table->string("direccion")->nullable();
            $table->string("telefono")->nullable();
            $table->string("parentesco")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('falimiar');
    }
};