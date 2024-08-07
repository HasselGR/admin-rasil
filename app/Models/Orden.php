<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    protected $table = 'ordenes';

    protected $primaryKey = 'id_orden';

    protected $fillable = [
        'id_plato',
        'nombre_plato',
        'fecha',
        'hora',
        'id_factura',
    ];

    public function plato()
    {
        return $this->belongsTo(Plato::class, 'id_plato', 'id_plato');
    }
}
