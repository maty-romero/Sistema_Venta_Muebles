<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class OfertaTipoValida implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $fechaInicio = request()->input('fechaInicio');
        $fechaFin = request()->input('fechaFin');

        $results = DB::select(
            "SELECT o.id, o.fecha_inicio_oferta, o.fecha_fin_oferta, ot.id_tipo_mueble
        FROM `ofertas_tipos_muebles` AS ot
        INNER JOIN `ofertas` AS o ON o.id = ot.id_oferta_tipo
        WHERE ot.id_tipo_mueble = '$value'
        AND (ot.deleted_at IS NULL and o.deleted_at IS NULL)
            AND (('$fechaInicio' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta) 
            OR ('$fechaFin' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta)
            OR (o.fecha_inicio_oferta BETWEEN '$fechaInicio' AND '$fechaFin')
            OR (o.fecha_fin_oferta BETWEEN '$fechaInicio' AND '$fechaFin'))"
        );

        if (count($results) > 0) {
            $fail = 'Ya existe una oferta de tipo dentro de ese periodo y por el mismo monto';
        }
        $fail = 'ProbandoTipo';
    }
}
