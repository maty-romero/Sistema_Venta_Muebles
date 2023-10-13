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
        Schema::create('detalles_combos', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad_producto_combo');
            $table->timestamps();
            $table->unsignedBigInteger('id_producto'); 
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->unsignedBigInteger('id_oferta_combo'); 
            $table->foreign('id_oferta_combo')->references('id_oferta_combo')->on('ofertas_combos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_combos');
    }
};
