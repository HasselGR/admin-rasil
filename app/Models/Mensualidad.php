<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensualidad extends Model
{
    use HasFactory;

    protected $table = 'mensualidad'; // Nombre de la tabla

    protected $primaryKey = 'id_mensualidad'; // Llave primaria

    protected $fillable = [
        'id_local',
        'id_cliente',
        'debe',
        'descripcion',
        'fecha'
    ];

    // Relación con el modelo LocalRenta
    public function local()
    {
        return $this->belongsTo(LocalRenta::class, 'id_local', 'id_local');
    }

    // Relación con el modelo ClientesRenta
    public function cliente()
    {
        return $this->belongsTo(ClienteRenta::class, 'id_cliente', 'id_cliente');
    }
}
