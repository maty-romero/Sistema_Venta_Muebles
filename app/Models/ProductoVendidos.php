<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoVendidos extends Model
{
    use HasFactory;
    

    protected $fillable = ["unidades_vendidas_prod", "precio_venta_prod"]; //campos solicitados al momento de enviar el request
    protected $table = "productos_vendidos"; //tabla a referenciar


}
