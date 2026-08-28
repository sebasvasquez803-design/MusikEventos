<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoPersona extends Model
{
    protected $table = 'tipo_persona';

    protected $primaryKey = 'id_tipo_persona';

    public $timestamps = true;

    protected $fillable = [
        'nombre_tipo',
    ];

    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'id_tipo_persona', 'id_tipo_persona');
    }
}
