<?php
// app/Models/ClienteRenta.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteRenta extends Model
{
    use HasFactory;
    protected $table = 'clientes_renta';
    protected $primaryKey = 'id_cliente'; // Usar id_cliente como clave primaria

    protected $fillable = ['nombre_razon_social', 'rif', 'telefono', 'correo'];

    public function rentas()
    {
        return $this->hasMany(RentaLocales::class, 'id_cliente');
    }
}
