<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductoVendido>
 */
class ProductoVendidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        static $key1 = [6, 8, 5, 4, 10, 3, 9, 1, 2, 7];
        static $key2 = [9, 7, 1, 8, 6, 3, 2, 10, 4, 5];
        static $key3 = [3, 1, 6, 8, 4, 2, 5, 10, 7, 9];

        return [
            "unidades_vendidas_prod" => fake()->numberBetween($min = 1, $max = 100),
            "precio_venta_prod" => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 500000),
            "id_producto" => array_pop($key1),
            "id_venta" => array_pop($key2),
            "id_oferta" => array_pop($key3),

        ];
    }
}
