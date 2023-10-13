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
        Schema::create('clientes', function (Blueprint $table) {
            $table->primary('id_usuario_cliente');
            $table->string('nombre_cliente');
            $table->enum('tipo_cliente', ['fisico', 'juridico']);
            $table->unique('dni_cuit');
            $table->string('codigo_postal_cliente');
            $table->timestamps();
            $table->unsignedBigInteger('id_usuario_cliente');
            $table->foreign('id_usuario_cliente')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
