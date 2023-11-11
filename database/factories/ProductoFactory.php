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
            "imagenUrl" => fake()->randomElement(["https://unsplash.com/es/fotos/sofa-de-tela-verde-fZuleEfeA1Q","https://unsplash.com/es/fotos/silla-acolchada-amarilla-con-marco-de-madera-marron-_HqHX3LBN18","https://unsplash.com/es/fotos/planta-verde-en-maceta-de-ceramica-blanca-IH7wPsjwomc"]),
            "id_tipo_mueble"=>fake()->numberBetween($min = 1, $max = 2),
        ];
    }
}
