<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenDetalle extends Model
{
    use HasFactory;

    protected $table = 'orden_detalle';  // Nombre de la tabla

    protected $primaryKey = 'id_detalle';  // Clave primaria

    protected $fillable = [
        'id_orden',
        'id_plato',
        'nombre_plato',
        'cantidad',
        'precio_unitario',
        'total',
    ];

    // Relación inversa con Orden
    public function orden()
    {
        return $this->belongsTo(Orden::class, 'id_orden', 'id_orden');
    }

    // Relación con el modelo Plato (opcional, si deseas acceder a los datos del plato desde este modelo)
    public function plato()
    {
        return $this->belongsTo(Plato::class, 'id_plato', 'id_plato');
    }
}