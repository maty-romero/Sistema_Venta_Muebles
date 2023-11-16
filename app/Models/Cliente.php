<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = "id_usuario_cliente";
    protected $fillable = ["nombre_cliente", "tipo_cliente", "dni_cuit", "codigo_postal_cliente", "nro_telefono"]; //campos solicitados al momento de enviar el request
    protected $table = "clientes"; //tabla a referenciar

    // Relaciones 

    //1 a M con Venta
    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class, "id_usuario_cliente");
    }

    //1:1 cliente-usuario

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, "id_usuario_cliente");
    }

    public static function crearCliente($idUsr)
    {
        if (request()->input('cmbRolUsuario') == 'cliente') {
            $cliente = new Cliente();
            $cliente->id_usuario_cliente = $idUsr;
            $cliente->dni_cuit = request()->input('dni_cuit');
            $cliente->nombre_cliente = request()->input('nombreCliente');
            $cliente->codigo_postal_cliente = request()->input('codigoPostal');
            $cliente->tipo_cliente = request()->input('cmbTipoCliente');
            $cliente->nro_telefono = request()->input('telefono');

            $cliente->save();
        }
    }

    public static function actualizarCliente($idUsuario)
    {
        if (request()->input('cmbRolUsuario') == 'cliente') {
            $cliente = Cliente::where('id_usuario_cliente', $idUsuario)->first();

            // Verifica si el cliente existe
            if ($cliente) {
                $cliente->dni_cuit = request()->input('dni_cuit');
                $cliente->nombre_cliente = request()->input('nombreCliente');
                $cliente->codigo_postal_cliente = request()->input('codigoPostal');
                $cliente->tipo_cliente = request()->input('cmbTipoCliente');
                $cliente->nro_telefono = request()->input('telefono');

                $cliente->save();
            }
        }
    }
}
