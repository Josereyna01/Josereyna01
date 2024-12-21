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
        Schema::create('afiliaciones', function (Blueprint $table) {
            $table->id();
            
            // Nueva columna user_id como clave foránea
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('pdf_path')->nullable();
            $table->string('nombre_uno');
            $table->string('ap_paterno_uno');
            $table->string('ap_materno_uno');
            $table->bigInteger('tel_uno');
            $table->string('nombre_dos')->nullable();
            $table->string('ap_paterno_dos')->nullable();
            $table->string('ap_materno_dos')->nullable();
            $table->bigInteger('tel_dos')->nullable();
            $table->string('nombre_tres')->nullable();
            $table->string('ap_paterno_tres')->nullable();
            $table->string('ap_materno_tres')->nullable();
            $table->bigInteger('tel_tres')->nullable();
            $table->string('seccion');
            $table->string('municipio');
            $table->string('colonia');
            $table->string('calle');
            $table->string('no_casa');
            $table->string('placa');
            $table->bigInteger('modelo');
            $table->string('marca');
            $table->string('tipo');
            $table->string('color');
            $table->string('serie');
            $table->string('metodo_pago');
            $table->string('tipo_seguro')->nullable();
            $table->string('tramito_seguro')->nullable();
            $table->string('descripcion_seguro')->nullable();
            $table->string('no_poliza')->nullable();
            $table->string('comprobante')->nullable();
            $table->string('vencimiento')->nullable();
            $table->string('timestamp_tramito_seguro')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('afiliaciones');
    }
};
