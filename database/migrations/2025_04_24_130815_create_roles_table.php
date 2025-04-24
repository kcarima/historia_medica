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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        DB::table('users')->insert(
            [
                [
                    'name' => 'admin' ,
                    'description' => 'Administrador'],
                [
                    'name' => 'medico' ,
                    'description' => 'Médico'],
                [
                   'name' => 'secretario' ,
                    'description' => 'Secretario'],
                [
                    'name' => 'historia' ,
                    'description' => 'Historia Médica'],

            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};