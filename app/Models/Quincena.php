<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quincena extends Model
{
    use HasFactory;

    protected $table = 'quincenas';

    protected $primaryKey = 'id_quincena'; // Especifica el nombre del campo de ID

    protected $fillable = [
        'fecha_inicio',
        'fecha_final',
        'descripcion',
    ];
    public function asignacionesEmpleados()
    {
        return $this->hasMany(AsignacionEmpleado::class, 'id_quincena', 'id_quincena');
    }
}