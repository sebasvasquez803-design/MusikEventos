<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    protected $table = 'usuario';

    protected $primaryKey = 'id_usuario';

    public $timestamps = true;

    protected $fillable = [
        'tipo_doc',
        'numero_doc',
        'id_tipo_persona',
        'nombre',
        'apellido',
        'sexo',
        'celular',
        'fecha_nacimiento',
        'avatar',
        'estado',
        'fecha_registro',
        'nombre_artistico',
    ];

    protected $casts = [
        'estado' => 'boolean',
        'fecha_nacimiento' => 'date',
        'fecha_registro' => 'date',
    ];

    public function tipoPersona(): BelongsTo
    {
        return $this->belongsTo(TipoPersona::class, 'id_tipo_persona', 'id_tipo_persona');
    }

    public function experienciaLaboral(): HasMany
    {
        return $this->hasMany(ExperienciaLaboral::class, 'numero_doc', 'numero_doc');
    }

    public function redesSociales(): HasMany
    {
        return $this->hasMany(RedesSocial::class, 'numero_doc', 'numero_doc');
    }

    public function curriculums(): HasMany
    {
        return $this->hasMany(Curriculum::class, 'numero_doc', 'numero_doc');
    }

    public function resenas(): HasMany
    {
        return $this->hasMany(Resena::class, 'numero_doc', 'numero_doc');
    }

    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class, 'numero_doc', 'numero_doc');
    }

    public function subgeneros(): HasMany
    {
        return $this->hasMany(Subgenero::class, 'numero_doc', 'numero_doc');
    }
}
