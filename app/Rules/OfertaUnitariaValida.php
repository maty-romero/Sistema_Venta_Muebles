<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class OfertaUnitariaValida implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (request()->input('tipoOferta') == 'unitaria') {
            $fechaInicio = request()->input('fechaInicio');
            $fechaFin = request()->input('fechaFin');
            foreach ($value as $prod) {
                $idProd = (int)explode(".", $prod)[0];

                $results = DB::select(
                    "SELECT p.id, o.id 
                    FROM `productos` AS p 
                    INNER JOIN `oferta_producto` AS op ON p.id = op.id_producto
                    INNER JOIN `ofertas` AS o ON o.id = op.id_oferta
                    WHERE p.id = '$idProd'
                    AND (p.deleted_at IS NULL and op.deleted_at IS NULL and o.deleted_at)
                        AND (('$fechaInicio' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta) 
                        OR ('$fechaFin' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta)
                        OR (o.fecha_inicio_oferta BETWEEN '$fechaInicio' AND '$fechaFin')
                        OR (o.fecha_fin_oferta BETWEEN '$fechaInicio' AND '$fechaFin'))"
                );

                if (count($results) > 0) {
                    $fail = 'Uno de los productos ya tiene una oferta de Unitaria dentro de ese periodo';
                }
            }
            $fail = 'ProbandoUnitaria';
        }
    }
}
