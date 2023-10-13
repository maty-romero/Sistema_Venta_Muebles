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
        Schema::create('ventas', function (Blueprint $table) {
            $table->primary("id");
            $table->dateTime('fecha_venta')->default(new DateTime());
            $table->float('monto_final_venta')->nullable()->default(0.00);
            $table->integer('nro_pago');
         //   $table->increments('nro_venta');
         $table->timestamps();
         $table->unsignedBigInteger('user_id'); 
         $table->foreign('user_id')->references('id')->on('users');
         $table->unsignedBigInteger('id_oferta_monto'); 
         $table->foreign('id_oferta_monto')->references('id_monto_oferta')->on('ofertas_montos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
