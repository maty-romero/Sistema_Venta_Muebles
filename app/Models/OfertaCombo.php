<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaCombo extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre_combo" 
    ]; 
    protected $table = "ofertas_combos"; //tabla a referenciar
}
