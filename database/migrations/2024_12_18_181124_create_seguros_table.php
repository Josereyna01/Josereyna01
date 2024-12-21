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
        Schema::create('seguros', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_seguro_seguro');
            $table->string('tramito_seguro_seguro')->nullable();
            $table->string('descripcion_seguro_seguro');
            $table->string('no_poliza_seguro');
            $table->string('nombre_seguro');
            $table->string('ap_paterno_seguro');
            $table->string('ap_materno_seguro');
            $table->bigInteger('telefono_seguro');
            $table->string('placa_seguro')->nullable();
            $table->bigInteger('modelo_seguro');
            $table->string('marca_seguro');
            $table->string('tipo_seguro');
            $table->string('serie_seguro');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguros');
    }
};
