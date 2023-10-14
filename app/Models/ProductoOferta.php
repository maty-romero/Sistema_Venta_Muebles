<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoOferta extends Model
{
    use HasFactory;


    protected $fillable = ["id_producto", "id_oferta"];
    protected $table = "oferta_producto"; //tabla a referenciar

}
