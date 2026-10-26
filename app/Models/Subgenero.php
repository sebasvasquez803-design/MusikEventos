<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subgenero extends Model
{
    // La tabla real es "subgenero"
    protected $table = 'subgenero';

    // La PK real es "id_subgenero"
    protected $primaryKey = 'id_subgenero';

    // Si la tabla no tiene timestamps
    public $timestamps = false;

    // Campos permitidos para crear o actualizar
    protected $fillable = [
        'nombre_subgenero',
        'id_genero',
        'numero_doc',
        'nit',
    ];
    /** @return BelongsTo<Genero, $this> */
    public function genero(): BelongsTo
    {
        return $this->belongsTo(Genero::class, 'id_genero', 'id_genero');
    }
}