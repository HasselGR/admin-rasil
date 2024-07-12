<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeduccionEmpleado extends Model
{
    use HasFactory;

    protected $table = 'deducciones_empleados';
    protected $primaryKey='id_deduccion';
    
    protected $fillable = [
        'id_empleado',
        's_s_o',
        'id_quincena',
        'paro_forzoso',
        'ley_politica_habit',
        'sindicato',
        'descuento_faltas',
        'descuento_prestamos',
        'total_deducciones',
    ];

    public function empleado()
    {
        return $this->belongsTo(NominaEmpleado::class, 'id_empleado');
    }
    public function quincena()
    {
        return $this->belongsTo(Quincena::class, 'id_quincena');
    }
}
