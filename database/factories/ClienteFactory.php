<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        static $id = 1;

        return [
            'id_usuario_cliente' => $id++,
            'nombre_cliente' => fake()->name(),
            'tipo_cliente' => fake()->randomElement(['fisico', 'juridico']),
            "dni_cuit" => fake()->numberBetween($min = 10000000, $max = 99999999),
            "codigo_postal_cliente" => fake()->numberBetween($min = 10000000, $max = 99999999),
            "nro_telefono" => fake()->numberBetween($min = 10000000, $max = 99999999)
        ];
    }
}
