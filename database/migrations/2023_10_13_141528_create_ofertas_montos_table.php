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
        Schema::create('ofertas_montos', function (Blueprint $table) {
            $table->primary('id_oferta_monto');
            $table->decimal('monto_limite_descuento', 12, 2);
            $table->timestamps();
            $table->unsignedBigInteger('id_oferta_monto'); 
            $table->foreign('id_oferta_monto')->references('id')->on('ofertas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ofertas_montos');
    }
};
