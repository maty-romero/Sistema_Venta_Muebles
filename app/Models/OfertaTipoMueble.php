<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfertaTipoMueble extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id_oferta_tipo'; // se necesita esto cuando la id no es generica para que funcionen los metodos de eloquent
    protected $fillable = [
        "id_oferta_tipo", "id_tipo_mueble"
    ];
    protected $table = "ofertas_tipos_muebles"; //tabla a referenciar

    // M:1 ofertaTipoMueble-oferta

    public function oferta(): BelongsTo
    {
        return $this->belongsTo(Oferta::class, "id_oferta_tipo");
    }

    // M:1 ofertaTipoMueble-tipoMueble

    public function tipoMueble(): BelongsTo
    {
        return $this->belongsTo(Oferta::class, "id_tipo_mueble");
    }

    public static function crearOfertaTipo($id){
        $ofertaMonto = new OfertaTipoMueble();
        $ofertaMonto->id_oferta_tipo = $id;
        $ofertaMonto->id_tipo_mueble = request()->input('tipoMueble');
        $ofertaMonto->save();
    }
}
