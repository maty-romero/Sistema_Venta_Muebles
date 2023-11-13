<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Oferta>
 */
class OfertaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "fecha_inicio_oferta" => fake()->dateTimeBetween($startDate = '-1years', $endDate = 'now', $timezone = null),
            "fecha_fin_oferta" => fake()->dateTimeBetween($startDate = 'now', $endDate = '+3 years', $timezone = null),
            "porcentaje_descuento" => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0.01, $max = 99.99),
        ];
    }
}
