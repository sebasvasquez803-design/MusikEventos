<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RedesSocial extends Model
{
    protected $table = 'redes_sociales';

    protected $primaryKey = 'id_red_social';

    public $timestamps = false;

    protected $fillable = [
        'nombre_red',
        'url',
        'numero_doc',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'numero_doc', 'numero_doc');
    }
}
