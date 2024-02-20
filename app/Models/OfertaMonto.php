<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class OfertaMonto extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id_oferta_monto';
    protected $fillable = [
        "monto_limite_descuento"
    ];
    protected $table = "ofertas_montos"; //tabla a referenciar

    // M:1 ofertaMonto-oferta

    public function oferta(): BelongsTo
    {
        return $this->belongsTo(Oferta::class, "id_oferta_monto");
    }

    // 1:M ofertaMonto-venta

    public function venta(): HasMany
    {
        return $this->hasMany(Venta::class, "id_oferta_monto");
    }

    public static function crearOfertaMonto($id){
        $ofertaMonto = new OfertaMonto();
        $ofertaMonto->id_oferta_monto = $id;
        $ofertaMonto->monto_limite_descuento = request()->input('montoMin');
        $ofertaMonto->save();
    }

    public static function getOfertaMonto($monto)
    {
        $idOferta = DB::table('ofertas_montos')->select('id_oferta_monto')->where('monto_limite_descuento', '<=', $monto)->orderBy('monto_limite_descuento', 'desc')->first();
        if(isset($idOferta) && !is_null($idOferta)){
            $oferta = Oferta::find($idOferta->id_oferta_monto);
            return $oferta;
        }
        return null;
    }

    public static function validarOfertaMonto(){
        $fechaInicio = request()->input('fechaInicio');
        $fechaFin = request()->input('fechaFin');
        $monto = request()->input('montoMin');

        $results = DB::select(
            "SELECT o.id
        FROM `ofertas_montos` AS om
        INNER JOIN `ofertas` AS o ON o.id = om.id_oferta_monto
        WHERE om.monto_limite_descuento = '$monto'
        AND (o.deleted_at IS NULL and om.deleted_at IS NULL)
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
