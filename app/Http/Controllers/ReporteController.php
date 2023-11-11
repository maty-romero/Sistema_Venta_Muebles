<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComboVendido;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Oferta;
use App\Models\OfertaCombo;
use App\Models\OfertaTipoMueble;
use App\Models\Producto;
use App\Models\ProductoVendido;
use App\Models\User;


class ReporteController extends Controller
{

    public function index(){

      return (view("administrador.reportes.index"));  
    }
    
}
