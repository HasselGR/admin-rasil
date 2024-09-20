<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalRenta extends Model
{
    use HasFactory;
    protected $table = 'local_renta';
    protected $primaryKey = 'id_local'; // Usar el id_local como clave primaria

    protected $fillable = ['ubicacion', 'canon', 'nombre_local'];

    public function rentas()
    {
        return $this->hasMany(RentaLocales::class, 'id_local');
    }
}
