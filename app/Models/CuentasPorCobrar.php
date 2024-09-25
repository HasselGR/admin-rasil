<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentasPorCobrar extends Model
{
    use HasFactory;

    protected $table = 'cuentas_por_cobrar';

    protected $primaryKey = 'id_cuenta'; // ID primario

    protected $fillable = [
        'id_factura',
        'id_cliente',
        'nombre_cliente',
        'fecha_emision',
        'fecha_vencimiento',
        'monto_con_iva',
        'estado',
        'fecha_pago',
    ];

    public function cliente()
    {
        return $this->belongsTo(ClienteRenta::class, 'id_cliente', 'id_cliente');
    }
}
