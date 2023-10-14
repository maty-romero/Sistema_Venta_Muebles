<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class OfertaTipoMueble extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_oferta_tipo'; // se necesita esto cuando la id no es generica para que funcionen los metodos de eloquent
    protected $fillable = [
        "id_oferta_tipo", "id_tipo_mueble"
    ];
    protected $table = "ofertas_tipos_muebles"; //tabla a referenciar

    public function oferta(): BelongsTo
    {
        return $this->belongsTo(Oferta::class, "id_oferta_tipo");
    }

    public function tipoMueble(): BelongsTo
    {
        return $this->belongsTo(Oferta::class, "id_tipo_mueble");
    }
}
