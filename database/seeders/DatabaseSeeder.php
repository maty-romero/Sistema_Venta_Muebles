<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cliente;
use App\Models\ComboVendido;
use App\Models\DetalleCombo;
use App\Models\Oferta;
use App\Models\OfertaCombo;
use App\Models\OfertaMonto;
use App\Models\OfertaTipoMueble;
use App\Models\Producto;
use App\Models\ProductoOferta;
use App\Models\ProductoVendido;
use App\Models\TipoMueble;
use App\Models\Venta;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    // PARA CORRER ESTO HACES
    // 1. php artisan migrate:fresh (esto te borra todo y levanta la base de nuevo)
    // 2. php artisan db:seed (te crea todos los registros con data random)



    public function run(): void
    {
        User::factory(10)->create();
        Cliente::factory(10)->create();
        TipoMueble::factory(2)->create();
        Producto::factory(10)->create();
        Oferta::factory(10)->create();
        OfertaMonto::factory(10)->create();
        OfertaTipoMueble::factory(10)->create();
        OfertaCombo::factory(10)->create();
        Venta::factory(10)->create();
        ComboVendido::factory(10)->create();
        DetalleCombo::factory(10)->create();
        ProductoOferta::factory(10)->create();
        ProductoVendido::factory(10)->create();

        $usuarios = array(
            array('name' => 'julio', 'email' => 'cliente@gmail.com', 'email_verified_at' => now(), 'rol_usuario' => "cliente", "password" => "123456789", 'remember_token' => Str::random(10)),
            array('name' => 'pablo', 'email' => 'administrador@gmail.com', 'email_verified_at' => now(), 'rol_usuario' => "administrador", "password" => "123456789", 'remember_token' => Str::random(10)),
            array('name' => 'marcos', 'email' => 'jefe_ventas@gmail.com', 'email_verified_at' => now(), 'rol_usuario' => "jefe_ventas", "password" => "123456789", 'remember_token' => Str::random(10)),
            array('name' => 'sebastian', 'email' => 'gerente@gmail.com', 'email_verified_at' => now(), 'rol_usuario' => "gerente", "password" => "123456789", 'remember_token' => Str::random(10)),

        );

        foreach ($usuarios as $user) {
            User::create($user);
        }

        Cliente::create([
            'nombre_cliente' => 'sebastian',
            'tipo_cliente' => 'juridico',
            'dni_cuit' => "386689961",
            'codigo_postal_cliente' => "515342141409",
            "nro_telefono" => "212314211251",
            'id_usuario_cliente' => "11"
        ]);
    }
}
