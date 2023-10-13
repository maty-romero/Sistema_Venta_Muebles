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
        Schema::create('ofertas_tipos_muebles', function (Blueprint $table) {
            $table->primary('id_oferta_tipo');
            $table->timestamps();
            $table->unsignedBigInteger('id_oferta_tipo'); 
            $table->foreign('id_oferta_tipo')->references('id')->on('ofertas');
            $table->unsignedBigInteger('id_tipo_mueble');
            $table->foreign('id_tipo_mueble')->references('id')->on('tipos_muebles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ofertas_tipos_muebles');
    }
};
