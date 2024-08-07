<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;

    protected $table = 'ingredientes';
    
    protected $primaryKey = 'id_ingrediente';
    
    protected $fillable = [
        'nombre_ingrediente',
        'cantidad',
        'unidad_medida',
    ];

    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class, 'unidad_medida', 'id_unidad_medida');
    }

    public function medidasPlatos()
    {
        return $this->hasMany(MedidasPlato::class, 'id_ingrediente', 'id_ingrediente');
    }
}