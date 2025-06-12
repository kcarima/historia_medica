<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nombre del permiso (ej: create_post, edit_user)
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('permissions')->insert([
            ['name' => 'manage users','description' => 'Gestor de usuarios'],
            ['name' => 'manage roles','description' => 'Gestor de roles'],
            ['name' => 'manage permissions','description' => 'Gestor de permisos'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};