<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoMueble>
 */
class TipoMuebleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        static $tipos = ['exterior', 'interior'];
        static $autoinc = 0;

        return [
            'nombre_tipo_mueble' => $tipos[$autoinc++],
            // a veces puede darse que salga dos veces interior o exterior
        ];
    }
}
