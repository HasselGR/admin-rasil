<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    use HasFactory;

    protected $table = 'plato';

    protected $primaryKey = 'id_plato';

    protected $fillable = [
        'nombre_plato',
        'costo',
        'descripcion',
    ];

    public function medidasPlatos()
    {
        return $this->hasMany(MedidasPlato::class, 'id_plato', 'id_plato');
    }

    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'id_plato', 'id_plato');
    }
}
