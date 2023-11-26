<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class OfertaComboValida implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (request()->input('tipoOferta') == 'combo') {
            $fechaInicio = request()->input('fechaInicio');
            $fechaFin = request()->input('fechaFin');

            $comboSimilar = true;
            foreach ($value as $prod) {
                $idProd = (int)explode(".", $prod)[0];
                $cant = (int)explode("x", $prod)[count(explode("x", $prod)) - 1];

                $results = DB::select(
                    "SELECT o.id, o.fecha_inicio_oferta, o.fecha_fin_oferta
                FROM `ofertas` AS o
                INNER JOIN `oferta_combo_producto` AS cp ON o.id = cp.id_oferta_combo
                WHERE cp.id_producto = '$idProd' AND cp.cantidad_producto_combo = '$cant' 
                AND  (o.deleted_at IS NULL and cp.deleted_at IS NULL)
                    AND (('$fechaInicio' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta) 
                    OR ('$fechaFin' BETWEEN o.fecha_inicio_oferta AND o.fecha_fin_oferta)
                    OR (o.fecha_inicio_oferta BETWEEN '$fechaInicio' AND '$fechaFin')
                    OR (o.fecha_fin_oferta BETWEEN '$fechaInicio' AND '$fechaFin'))"
                );

                if (count($results) <= 0) {
                    $comboSimilar = false;
                }
                if ($comboSimilar) {
                    $fail = 'Ya existe un combo similar dentro del periodo indicado';
                }
                $fail = 'ProbandoCombo';
            }
            if ($comboSimilar) {
                $fail = 'Ya existe un combo similar dentro del periodo indicado';
            }
        }
    }
}
