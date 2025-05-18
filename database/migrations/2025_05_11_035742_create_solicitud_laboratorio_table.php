php
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
        Schema::create('solicitud_laboratorio', function (Blueprint $table) {
            $table->id();

            // Química
            $table->boolean('glucosa')->default(false);
            $table->boolean('urea')->default(false);
            $table->boolean('creatinina')->default(false);
            $table->boolean('colesterol_total')->default(false);
            $table->boolean('trigliceridos')->default(false);
            $table->boolean('acido_urico')->default(false);
            $table->boolean('transaminasas_tgo_tgp')->default(false);
            $table->boolean('bilirrubinas')->default(false);
            $table->boolean('fosfatasa_alcalina')->default(false);
            $table->boolean('ggt')->default(false);
            $table->boolean('proteinas_totales_fraccionadas')->default(false);
            $table->boolean('electrolitos')->default(false);
            $table->boolean('calcio')->default(false);
            $table->boolean('fosforo')->default(false);
            $table->boolean('magnesio')->default(false);

            // Hematología
            $table->boolean('hemograma_completo')->default(false);
            $table->boolean('vsg')->default(false);
            $table->boolean('pruebas_coagulacion')->default(false);
            $table->boolean('grupo_sanguineo_factor_rh')->default(false);

            // Orina y Cultivos
            $table->boolean('orina_completa')->default(false);
            $table->boolean('urocultivo')->default(false);
            $table->boolean('coprologico')->default(false);
            $table->boolean('coprocultivo')->default(false);

            // Serología
            $table->boolean('serologia')->default(false); // incluye VDRL, HIV, HBsAg, HCV
            $table->boolean('test_embarazo')->default(false);
            $table->boolean('pcr')->default(false);

            // Perfiles
            $table->boolean('perfil_tiroideo')->default(false);
            $table->boolean('perfil_lipidico')->default(false);
            $table->boolean('perfil_hepatico')->default(false);
            $table->boolean('perfil_renal')->default(false);
            $table->boolean('perfil_reumatico')->default(false);

            // Otros
            $table->text('otros_examenes')->nullable();
            $table->string('historia',null);
             $table->foreign('historia')->references('historia')->on('pacientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_laboratorio');
    }
};
