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
            "imagenUrl" => fake()->randomElement(["https://unsplash.com/es/fotos/sofa-de-tela-verde-fZuleEfeA1Q","https://unsplash.com/es/fotos/silla-acolchada-amarilla-con-marco-de-madera-marron-_HqHX3LBN18","https://unsplash.com/es/fotos/planta-verde-en-maceta-de-ceramica-blanca-IH7wPsjwomc"]),
        ];
    }
}
