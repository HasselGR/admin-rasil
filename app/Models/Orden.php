<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    protected $table = 'orden';  // Nombre de la tabla

    protected $primaryKey = 'id_orden';  // Clave primaria

    protected $fillable = [
        'fecha',
        'hora',
        
    ];

    // Relación uno a muchos con OrdenDetalle
    public function detalles()
    {
        return $this->hasMany(OrdenDetalle::class, 'id_orden', 'id_orden');
    }
}