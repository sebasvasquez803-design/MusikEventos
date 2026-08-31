<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Factura extends Model
{
    protected $table = 'factura';

    protected $primaryKey = 'id_factura';

    public $timestamps = false;

    protected $fillable = [
        'numero_serie',
    ];

    public function detallePago(): BelongsTo
    {
        return $this->belongsTo(DetallePago::class, 'numero_serie', 'numero_serie');
    }
}
