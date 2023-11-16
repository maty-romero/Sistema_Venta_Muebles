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
            $table->id();
            $table->dateTime('fecha_venta');
            $table->decimal('monto_final_venta', 12, 2)->nullable()->default(0.00);
            $table->integer('nro_pago');
            $table->string('codigo_postal_destino');
            $table->string('domicilio_destino');
            //   $table->increments('nro_venta');
            $table->timestamps();
            $table->unsignedBigInteger('id_usuario_cliente');
            $table->foreign('id_usuario_cliente')->references('id_usuario_cliente')->on('clientes');
            $table->unsignedBigInteger('id_oferta_monto')->nullable()->default(null);
            $table->foreign('id_oferta_monto')->references('id_oferta_monto')->on('ofertas_montos');
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
