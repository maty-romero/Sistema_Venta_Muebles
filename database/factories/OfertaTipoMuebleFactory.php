<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OfertaTipoMueble>
 */
class OfertaTipoMuebleFactory extends Factory
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
            "id_tipo_mueble"=>fake()->numberBetween($min = 1, $max = 2),
            "id_oferta_tipo"=> $id++,
        ];
    }
}
