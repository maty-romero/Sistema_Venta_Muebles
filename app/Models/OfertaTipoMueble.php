<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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

    public static function validarOfertaTipo(){
        $tipoId = request()->input('tipoMueble'); //Id de tipo
        $fechaInicio = request()->input('fechaInicio');
        $fechaFin = request()->input('fechaFin');

        $results = DB::select(
            "SELECT o.id, o.fecha_inicio_oferta, o.fecha_fin_oferta, ot.id_tipo_mueble
        FROM `ofertas_tipos_muebles` AS ot
        INNER JOIN `ofertas` AS o ON o.id = ot.id_oferta_tipo
        WHERE ot.id_tipo_mueble = '$tipoId'
        AND (ot.deleted_at IS NULL and o.deleted_at IS NULL)
            AND (('$fechaInicio' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta) 
            OR ('$fechaFin' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta)
            OR (o.fecha_inicio_oferta BETWEEN '$fechaInicio' AND '$fechaFin')
            OR (o.fecha_fin_oferta BETWEEN '$fechaInicio' AND '$fechaFin'))"
        );

        if (count($results) > 0) {
            return false;
        }
        return true;

    }
}
