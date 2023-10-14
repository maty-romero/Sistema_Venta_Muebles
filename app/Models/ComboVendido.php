<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComboVendido extends Model
{
    use HasFactory;

    //campos solicitados al momento de enviar el request
    protected $fillable = [
        "id_venta",
        "id_oferta_combo",
        "unidades_vendidas_combo",
    ];

    protected $table = "combos_vendidos"; //tabla a referenciar


}
