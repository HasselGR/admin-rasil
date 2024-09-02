<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedidasPlato extends Model
{
    use HasFactory;

    protected $table = 'medidas_platos';

    protected $primaryKey = 'id_medida_plato';

    protected $fillable = [
        'id_plato',
        'id_ingrediente',
        'unidad_medida',
        'nombre_plato',
        'nombre_ingrediente',
        'nombre_unidad',
        'cantidad'
    ];

    public function plato()
    {
        return $this->belongsTo(Plato::class, 'id_plato', 'id_plato');
    }

    public function ingrediente()
    {
        return $this->belongsTo(Ingrediente::class, 'id_ingrediente', 'id_ingrediente');
    }

    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class, 'unidad_medida', 'id_unidad_medida');
    }
}
