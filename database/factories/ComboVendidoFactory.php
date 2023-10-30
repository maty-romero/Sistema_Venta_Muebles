<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComboVendido>
 */
class ComboVendidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        static $key1 = [4, 6, 3, 2, 9, 10, 7, 5, 1, 8];
        static $key2 = [2, 10, 8, 6, 4, 5, 7, 3, 9, 1];

        return [
            "unidades_vendidas_combo" => fake()->numberBetween($min = 1, $max = 100),
            "precio_combo" => fake()->numberBetween($min = 10.00, $max = 400.00),
            "id_venta" => array_pop($key1),
            "id_oferta_combo" => array_pop($key2),
        ];
    }
}
