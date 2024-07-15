<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroCompra extends Model
{
    use HasFactory;

    protected $table = 'compra_libro';
    protected $primaryKey = 'id_compra';

    protected $fillable = [
        'id_quincena',
        'fecha_factura',
        'nro_rif',
        'prov_razon_social',
        'nro_factura',
        'nro_control_factura',
        'tipo_transaccion',
        'nro_factura_afectada',
        'total_compras',
        'compras_sin_derecho_iva',
        'descuento_tgif',
        'base_impo_contribuyente',
        'alicuota_contribuyente',
        'impuesto_iva_contribuyente',
        'base_impo_contribuyente_alic_red',
        'alicuota_contribuyente_alic_red',
        'impuesto_iva_contribuyente_alic_red',
        'base_impo_no_contribuyente_alic_red',
        'alicuota_no_contribuyente_alic_red',
        'impuesto_iva_no_contribuyente_alic_red',
        'iva_retenido',
        'nro_comprobante',
        'fecha_comprobante_retencion',
    ];

    public function quincena()
    {
        return $this->belongsTo(Quincena::class, 'id_quincena');
    }
}