<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionEmpleado extends Model
{
    use HasFactory;

    protected $table = 'asignaciones_empleados';
    protected $primaryKey = 'id_asignaciones';

    protected $fillable = [
        'id_empleado',
        'dias_trabajados',
        'dias_descanso',
        'horas_extra_diurnas',
        'horas_extra_nocturnas',
        'bono_nocturno',
        'clt',
        'dia_feriado_trabajado',
        'total_devengado',
    ];

    public function empleado(){
        return $this->belongsTo(NominaEmpleado::class, 'id_empleado');
    }
}