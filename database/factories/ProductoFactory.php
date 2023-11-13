<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nombre_producto" => fake()->name(),
            "descripcion" => fake()->text(),
            "discontinuado" => 0,
            "stock" => fake()->randomFloat($nbMaxDecimals = NULL, $min = 1000, $max = 5000),
            "precio_producto" => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 20000),
            "largo" => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 200),
            "ancho" => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 200),
            "alto" => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 200),
            "material" => fake()->randomElement(['acero', "aluminio", 'madera', "roble", "pino"]),
            "imagenUrl" => fake()->randomElement([
                "https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                "https://images.unsplash.com/photo-1505843490538-5133c6c7d0e1?q=80&w=1818&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            ]),
            "id_tipo_mueble" => fake()->numberBetween($min = 1, $max = 2),
        ];
    }
}
