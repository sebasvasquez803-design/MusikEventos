<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaqueteGrupo extends Model
{
    protected $table = 'paquete_grupo';

    protected $primaryKey = 'id_paquete';

    public $timestamps = false;

    protected $fillable = [
        'nombre_paquete',
        'contenido',
        'descripcion',
        'precio',
        'duracion',
        'nit',
    ];

    protected $casts = [
        'precio' => 'decimal:5',
    ];

    public function grupoMusical(): BelongsTo
    {
        return $this->belongsTo(GrupoMusical::class, 'nit', 'nit');
    }
}
