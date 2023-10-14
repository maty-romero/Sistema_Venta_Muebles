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
        Schema::create('oferta_combo', function (Blueprint $table) {
            $table->primary('id_oferta_combo');
            $table->string('nombre_combo');
            $table->timestamps();
            $table->unsignedBigInteger('id_oferta_combo'); 
            $table->foreign('id_oferta_combo')->references('id')->on('ofertas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oferta_combo_producto');
    }
};
