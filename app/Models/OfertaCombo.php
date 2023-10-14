<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfertaCombo extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_oferta_combo';
    protected $fillable = [
        "nombre_combo"
    ];
    protected $table = "ofertas_combos"; //tabla a referenciar


    public function oferta(): BelongsTo
    {
        return $this->belongsTo(Oferta::class);
    }
}
