<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OfertaCombo>
 */
class OfertaComboFactory extends Factory
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
            "id_oferta_combo" => $id++,
            "nombre_combo" => fake()->name()
        ];
    }
}
