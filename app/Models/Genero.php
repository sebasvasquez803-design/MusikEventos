<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    // Si tu tabla en la base de datos se llama "genero", hay que declararla.
    // En tu proyecto usas referencias como "exists:genero,id_genero",
    // así que la tabla real es "genero" y no "generos".
    protected $table = 'genero';

    // La PK de la tabla es id_genero
    protected $primaryKey = 'id_genero';

    // Si tu tabla no tiene created_at ni updated_at, lo desactivamos.
    public $timestamps = false;

    // Campos que se pueden guardar de forma masiva
    protected $fillable = [
        'nombre_genero',
    ];
    public function subgeneros()
    {
        return $this->hasMany(Subgenero::class, 'id_genero', 'id_genero');
    }
}
