<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resena extends Model
{
    protected $table = 'resenas';

    protected $primaryKey = 'id_resena';

    public $timestamps = false;

    protected $fillable = [
        'numero_estrellas',
        'comentario',
        'fecha',
        'numero_doc',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'numero_doc', 'numero_doc');
    }
}
