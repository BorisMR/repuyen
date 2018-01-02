<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receptor extends Model
{
    protected $table = "receptores";

    protected $fillable = [
        'nombre',
        'rut',
        'direccion',
        'email',
        'telefono',
        'comentario',
        'comprobante_deposito'
    ];

    public function envio()
    {
        return $this->belongsTo(Envio::class);
    }
}
