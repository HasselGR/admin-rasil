<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroVenta extends Model
{
    use HasFactory;

    protected $table = 'venta_libro';
    protected $primaryKey = 'id_venta';

    protected $fillable = [
        'id_quincena',
        'fecha_factura',
        'nro_rif',
        'prov_razon_social',
        'nro_factura',
        'nro_control_factura',
        'tipo_transaccion',
        'total_ventas',
        'base_impo_contribuyente',
        'alicuota_contribuyente',
        'impuesto_iva_contribuyente',
        'base_impo_no_contribuyente',
        'alicuota_no_contribuyente',
        'impuesto_iva_no_contribuyente',
        'iva_retenido',
        'nro_comprobante',
        'fecha_comprobante_retencion',
    ];

    public function quincena()
    {
        return $this->belongsTo(Quincena::class, 'id_quincena');
    }
}
