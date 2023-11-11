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
            "nombre_combo" => fake()->name(),
            "imagenUrl" => fake()->randomElement([
                "https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                "https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            ]),
        ];
    }
}
