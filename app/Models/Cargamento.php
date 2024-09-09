<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargamento extends Model
{
    use HasFactory;

    protected $table = 'cargamentos';

    protected $primaryKey = 'id_cargamento'; // Aquí el nombre correcto de la clave primaria, si no es 'id'

    protected $fillable = ['nro_factura', 'fecha'];

    public function ingredientesCargamento()
    {
        return $this->hasMany(IngredienteCargamento::class, 'id_cargamento');
    }
}