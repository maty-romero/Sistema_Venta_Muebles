<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class OfertaMontoValida implements ValidationRule
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
            "SELECT o.id
        FROM `ofertas_montos` AS om
        INNER JOIN `ofertas` AS o ON o.id = om.id_oferta_monto
        WHERE om.monto_limite_descuento = '$value'
        AND (o.deleted_at IS NULL and om.deleted_at IS NULL)
            AND (('$fechaInicio' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta) 
            OR ('$fechaFin' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta)
            OR (o.fecha_inicio_oferta BETWEEN '$fechaInicio' AND '$fechaFin')
            OR (o.fecha_fin_oferta BETWEEN '$fechaInicio' AND '$fechaFin'))"
        );

        if (count($results) > 0) {
            $fail = 'Ya existe una oferta por monto dentro de ese periodo y con el mismo monto límite';
        }
        $fail = 'ProbandoMonto';
    }
}
