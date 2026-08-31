<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExperienciaLaboral extends Model
{
    protected $table = 'experiencia_laboral';

    protected $primaryKey = 'id_experiencia';

    public $timestamps = true;

    protected $fillable = [
        'numero_doc',
        'anio_inicio',
        'anio_fin',
        'titulo_obtenido',
        'habilidades_principales',
        'academia_formacion',
        'estudios',
        'publico_privado',
    ];

    protected $casts = [
        'publico_privado' => 'boolean',
        'anio_inicio' => 'datetime',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'numero_doc', 'numero_doc');
    }
}
