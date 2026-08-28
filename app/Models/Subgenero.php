<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subgenero extends Model
{
    protected $table = 'subgenero';

    protected $primaryKey = 'id_subgenero';

    public $timestamps = false;

    protected $fillable = [
        'nombre_subgenero',
        'id_genero',
        'numero_doc',
        'nit',
    ];

    public function genero(): BelongsTo
    {
        return $this->belongsTo(Genero::class, 'id_genero', 'id_genero');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'numero_doc', 'numero_doc');
    }

    public function grupoMusical(): BelongsTo
    {
        return $this->belongsTo(GrupoMusical::class, 'nit', 'nit');
    }
}
