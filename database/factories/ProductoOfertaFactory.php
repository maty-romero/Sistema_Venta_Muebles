<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductoOferta>
 */
class ProductoOfertaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        static $key1 = [9, 4, 1, 8, 6, 7, 3, 2, 10, 5];
        static $key2 = [7, 4, 9, 6, 5, 3, 8, 1, 2, 10];

        return [
            "id_producto" => array_pop($key1),
            "id_oferta" =>   array_pop($key2),
        ];
    }
}
