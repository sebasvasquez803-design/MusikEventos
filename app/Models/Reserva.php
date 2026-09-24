<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reserva';
    protected $primaryKey = 'id_reserva';
    public $timestamps = false;

    protected $fillable = [
        'fecha', 'hora', 'direccion', 'valor',
        'estado', 'numero_doc', 'nit'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'numero_doc', 'numero_doc');
    }

    public function grupoMusical()
    {
        return $this->belongsTo(GrupoMusical::class, 'nit', 'nit');
    }
}
