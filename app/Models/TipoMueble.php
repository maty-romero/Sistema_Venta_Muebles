<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class TipoMueble extends Model
{
    use HasFactory;

    protected $fillable = ["nombre_tipo_mueble"];
    protected $table = "tipos_muebles"; //tabla a referenciar

    // 1:M tipoMueble-producto

    public function producto(): hasMany
    {
        return $this->hasMany(Producto::class, "id_tipo_mueble");
    }
}
