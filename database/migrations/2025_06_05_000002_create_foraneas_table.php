<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('foraneas', function (Blueprint $table) {
            $table->id();
            $table->string('historia');
            $table->string('archivo');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('foraneas');
    }
};
