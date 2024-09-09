<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredienteCargamento extends Model
{
    use HasFactory;

    protected $table = 'ingredientes_cargamentos';

    protected $primaryKey = 'id_detalle_cargamento';
    protected $fillable = ['id_cargamento', 'id_ingrediente', 'nombre_ingrediente', 'cantidad'];

    public function cargamento()
    {
        return $this->belongsTo(Cargamento::class, 'id_cargamento');
    }

    public function ingrediente()
    {
        return $this->belongsTo(Ingrediente::class, 'id_ingrediente');
    }
}
