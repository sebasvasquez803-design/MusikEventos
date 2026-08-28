<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reserva extends Model
{
    protected $table = 'reserva';

    protected $primaryKey = 'id_reserva';

    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'hora',
        'direccion',
        'valor',
        'estado',
        'numero_doc',
        'nit',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i:s',
        'valor' => 'decimal:5',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'numero_doc', 'numero_doc');
    }

    public function grupoMusical(): BelongsTo
    {
        return $this->belongsTo(GrupoMusical::class, 'nit', 'nit');
    }

    public function detallePagos(): HasMany
    {
        return $this->hasMany(DetallePago::class, 'id_reserva', 'id_reserva');
    }
}
