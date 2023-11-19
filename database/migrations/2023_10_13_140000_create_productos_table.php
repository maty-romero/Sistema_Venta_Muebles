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
            $table->id("id");
            $table->string('nombre_producto', 100)->unique();
            $table->string('descripcion', 500)->nullable();
            $table->boolean('discontinuado')->default(false);
            $table->integer('stock')->default(1);
            $table->decimal('precio_producto', 12, 2)->default(0.00);
            $table->float('largo')->default(0.00);
            $table->float('ancho')->default(0.00);
            $table->float('alto')->default(0.00);
            $table->string('material', 100)->nullable();
            $table->string('imagenURL')->default("https://images.unsplash.com/photo-1505843490538-5133c6c7d0e1?q=80&w=1818&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
            $table->timestamps();
            $table->unsignedBigInteger('id_tipo_mueble');
            $table->foreign('id_tipo_mueble')->references('id')->on('tipos_muebles');
            $table->softDeletes();
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
