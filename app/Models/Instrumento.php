<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instrumento extends Model
{
    protected $table = 'instrumento';

    protected $primaryKey = 'id_instrumento';

    public $timestamps = false;

    protected $fillable = [
        'nombre_instrumento',
        'descripcion',
        'tipo_instrumento',
    ];
}
