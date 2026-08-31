<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DetallePago extends Model
{
    protected $table = 'detalle_pago';

    protected $primaryKey = 'numero_serie';

    public $timestamps = false;

    protected $fillable = [
        'fecha_pago',
        'precio_total',
        'precio_con_iva',
        'descuento',
        'estado_pago',
        'id_cliente',
        'id_reserva',
    ];

    protected $casts = [
        'fecha_pago' => 'datetime',
        'precio_total' => 'decimal:5',
        'precio_con_iva' => 'decimal:5',
        'descuento' => 'decimal:5',
        'estado_pago' => 'boolean',
    ];

    public function reserva(): BelongsTo
    {
        return $this->belongsTo(Reserva::class, 'id_reserva', 'id_reserva');
    }

    public function factura(): HasOne
    {
        return $this->hasOne(Factura::class, 'numero_serie', 'numero_serie');
    }
}
