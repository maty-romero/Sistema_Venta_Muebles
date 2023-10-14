<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OfertaMonto>
 */
class OfertaMontoFactory extends Factory
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
            "monto_limite_descuento"=> fake()->randomFloat($nbMaxDecimals = NULL, $min = 0.00, $max = 100000.00),
            "id_oferta_monto"=> $id++,
        ];
    }
}
