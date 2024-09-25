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

    protected $fillable = ['nombre_razon_social', 'rif', 'telefono', 'correo', 'saldo'];

    public function rentas()
    {
        return $this->hasMany(RentaLocales::class, 'id_cliente');
    }
    public function cuentasPorCobrar()
    {
        return $this->hasMany(CuentasPorCobrar::class, 'id_cliente', 'id_cliente');
    }


    public function mensualidades()
    {
        return $this->hasMany(Mensualidad::class, 'id_cliente', 'id_cliente');
    }
}
