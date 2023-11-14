<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleCombo>
 */
class DetalleComboFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "cantidad_producto_combo" => fake()->numberBetween($min = 1, $max = 20),
            "id_producto" => fake()->numberBetween($min = 1, $max = 10),
            "id_oferta_combo" => fake()->numberBetween($min = 1, $max = 10),
        ];
    }
}
