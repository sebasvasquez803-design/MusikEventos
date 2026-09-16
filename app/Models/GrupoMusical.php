<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use App\Models\Resena;

class GrupoMusical extends Model
{
    protected $table = 'grupo_musical';

    protected $primaryKey = 'id_grupo_musical';

    public $timestamps = false;

    protected $fillable = [
        'nit',
        'nombre_grupo',
        'telefono',
        'email',
        'avatar',
        'logo',
        'video_url',
        'descripcion',
        'numero_doc',
        'precio_hora',
    ];

    protected $casts = [
        'precio_hora' => 'decimal:5',
    ];

    protected $appends = [
        'avatar_url',
        'logo_url',
    ];

    public function getAvatarUrlAttribute(): ?string
    {
        return $this->avatar ? Storage::disk('public')->url($this->avatar) : null;
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? Storage::disk('public')->url($this->logo) : null;
    }

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

    public function resenas(): HasMany
    {
        return $this->hasMany(Resena::class, 'nit', 'nit');
    }
}
