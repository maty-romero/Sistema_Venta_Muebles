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
        Schema::create('productos_vendidos', function (Blueprint $table) {
            $table->primary("id");
            $table->integer('unidades_vendidas_prod');
            $table->float('precio_venta_prod')->default(0.00);            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos_vendidos');
    }
};