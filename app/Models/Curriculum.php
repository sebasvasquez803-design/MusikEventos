<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Curriculum extends Model
{
    protected $table = 'curriculum';

    protected $primaryKey = 'id_experiencia';

    public $timestamps = false;

    protected $fillable = [
        'anio_inicio',
        'anio_fin',
        'eventos_realizados',
        'titulo_obtenido',
        'habilidades_principales',
        'academia_formacion',
        'estudios',
        'publico_privado',
        'numero_doc',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'numero_doc', 'numero_doc');
    }
}
