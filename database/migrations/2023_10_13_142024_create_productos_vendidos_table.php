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
            $table->primary(["id_venta",'id_producto']);
            $table->integer('unidades_vendidas_prod');
            $table->float('precio_venta_prod')->default(0.00);            
            $table->timestamps();
            $table->unsignedBigInteger('id_venta'); 
            $table->foreign('id_venta')->references('id')->on('ventas');
            $table->unsignedBigInteger('id_producto'); 
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->unsignedBigInteger('id_tipo_mueble'); 
            $table->foreign('id_tipo_mueble')->references('id')->on('tipos_muebles');
       
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
