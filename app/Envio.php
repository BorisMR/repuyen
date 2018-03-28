<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    protected $table = "envios";

    protected $fillable = [
        'id_producto',
        'id_seguimiento',
        'id_status',
        'id_user',
        'id_receptor'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function seguimiento()
    {
        return $this->belongsTo(Seguimiento::class);
    }

    public function emisor()
    {
        return $this->hasOne('App\User', 'id_user');
    }

    public function receptor()
    {
        return $this->belongsTo('App\Receptor', 'id_receptor');
    }
}
