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
            "nombre_producto"=> fake()->name(),
            "descripcion"=> fake()->text(),
            "discontinuado"=>fake()->boolean(),
            "stock"=>fake()->randomDigit(),
            "precio_producto"=>fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 20000), 
            "largo"=>fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 200) ,
            "ancho"=>fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 200) ,
            "alto"=>fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 200) ,
            "material"=> fake()->randomElement(['acero' ,"aluminio",'madera',"roble","pino"]),
            "id_tipo_mueble"=>fake()->numberBetween($min = 1, $max = 2),
        ];
    }
}
