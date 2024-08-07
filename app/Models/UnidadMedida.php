<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    use HasFactory;

    protected $table = 'unidad_medida';

    protected $primaryKey = 'id_unidad_medida';
    
    protected $fillable = [
        'nombre_unidad',
    ];

    public function ingredientes()
    {
        return $this->hasMany(Ingrediente::class, 'unidad_medida', 'id_unidad_medida');
    }
}
