<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venta>
 */
class VentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "fecha_venta" => fake()->dateTimeBetween($startDate = 'now', $endDate = '+1 years', $timezone = null),
            "monto_final_venta" => fake()->randomFloat($nbMaxDecimals = NULL, $min = 100.00, $max = 100000.00),
            "nro_pago" => fake()->numberBetween($min = 10000000, $max = 99999999),
            "codigo_postal_destino" => fake()->numberBetween($min = 10000000, $max = 99999999),
            "domicilio_destino" => fake()->name(),
            "id_usuario_cliente" => fake()->numberBetween($min = 1, $max = 10),
            "id_oferta_monto" => fake()->numberBetween($min = 1, $max = 10),
        ];
    }
}
