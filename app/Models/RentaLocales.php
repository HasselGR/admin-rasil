<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentaLocales extends Model
{
    use HasFactory;


    protected $table ='renta_locales';
    protected $primaryKey = 'id_renta';

    protected $fillable = [
        'id_local', 
        'id_cliente', 
        'fecha', 
        'concepto', 
        'forma_pago', 
        'debe', 
        'haber', 
        'retencion_iva', 
        'retencion_isrf', 
        'saldo'
    ];

    public function local()
    {
        return $this->belongsTo(LocalRenta::class, 'id_local');
    }

    public function cliente()
    {
        return $this->belongsTo(ClienteRenta::class, 'id_cliente');
    }
}