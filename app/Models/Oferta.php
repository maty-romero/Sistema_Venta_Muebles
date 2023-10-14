<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Oferta extends Model
{
    use HasFactory;
    protected $fillable = [
        "fecha_inicio_oferta",
        "fecha_fin_oferta",
        "porcentaje_descuento",
    ];
    protected $table = "ofertas"; //tabla a referenciar


    public function ofertaCombo(): hasMany
    {
        return $this->hasMany(OfertaCombo::class, "id_oferta_combo");
    }

    public function ofertaMonto(): hasMany
    {
        return $this->hasMany(OfertaMonto::class, "id_oferta_monto");
    }

    public function ofertaMueble(): hasMany
    {
        return $this->hasMany(OfertaTipoMueble::class, "id_oferta_tipo");
    }
}
