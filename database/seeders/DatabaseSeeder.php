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
use App\Models\ProductoVendidos;
use App\Models\TipoMueble;
use App\Models\Venta;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        ProductoVendidos::factory(10)->create(); //falta
    }
}
