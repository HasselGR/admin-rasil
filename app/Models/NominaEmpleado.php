<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominaEmpleado extends Model
{
    
    protected $table = 'nomina_empleados';

    protected $primaryKey = 'id_empleado';

    public $incrementing = true;

    protected $fillable = [
        'nombre_empleado',
        'cedula_identidad',
        'cod_contrato',
        'salario_gobierno',
        'salario_empresa',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
}
