<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GrupoMusical extends Model
{
    protected $table = 'grupo_musical';

    public $timestamps = false;

    protected $fillable = [
        'nit',
        'nombre_grupo',
        'telefono',
        'email',
        'avatar',
        'descripcion',
        'numero_doc',
        'precio_hora',
    ];

    protected $casts = [
        'precio_hora' => 'decimal:5',
    ];

    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class, 'nit', 'nit');
    }

    public function subgeneros(): HasMany
    {
        return $this->hasMany(Subgenero::class, 'nit', 'nit');
    }

    public function paquetes(): HasMany
    {
        return $this->hasMany(PaqueteGrupo::class, 'nit', 'nit');
    }
}
