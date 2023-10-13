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
        Schema::create('productos', function (Blueprint $table) {
            $table->primary("id");
            $table->string('nombre_producto', 100)->unique();
            $table->string('descripcion', 500)->nullable();
            $table->boolean('discontinuado')->default(false);
            $table->integer('stock')->default(1);
            $table->float('precio_producto')->default(0.00);
            $table->float('largo')->default(0.00);
            $table->float('ancho')->default(0.00);
            $table->float('alto')->default(0.00);
            $table->string('material', 100)->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('id_tipo_mueble'); 
            $table->foreign('id_tipo_mueble')->references('id')->on('tipos_muebles');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
