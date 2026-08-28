<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genero extends Model
{
    protected $table = 'genero';

    protected $primaryKey = 'id_genero';

    public $timestamps = false;

    protected $fillable = [
        'nombre_genero',
    ];

    public function subgeneros(): HasMany
    {
        return $this->hasMany(Subgenero::class, 'id_genero', 'id_genero');
    }
}
