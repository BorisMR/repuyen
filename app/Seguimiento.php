<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    //UNUSED

    protected $table = 'seguimientos';

    protected $fillable = [
        'id_user',
        'id_envio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function envio()
    {
        return $this->hasOne(Envio::class);
    }
}
