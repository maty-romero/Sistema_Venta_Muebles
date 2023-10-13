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
        Schema::create('combos_vendidos', function (Blueprint $table) {
            $table->primary(['id_venta', 'id_oferta_combo']);
            $table->integer('unidades_vendidas_combo');
            $table->timestamps();
            $table->unsignedBigInteger('id_venta'); 
            $table->foreign('id_venta')->references('id_venta')->on('ventas');
            $table->unsignedBigInteger('id_oferta_combo');
            $table->foreign('id_oferta_combo')->references('id_oferta_combo')->on('oferta_combo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combos_vendidos');
    }
};
