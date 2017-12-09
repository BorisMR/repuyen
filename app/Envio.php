<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    protected $table = "envios";

    protected $fillable = [
        'id_producto',
        'id_seguimiento',
        'id_status'
    ];

    public function productos(){
        return $this->hasMany(Producto::class);
    }

    public function seguimiento(){
        return$this->belongsTo(Seguimiento::class);
    }
}
