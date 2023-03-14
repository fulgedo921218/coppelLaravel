<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    use HasFactory;
    protected $table = "roles";
    public $timestamps = false;
    protected $fillable =[
        'nombre',
        'salario_hora',
        'bono',
        'jornada',
        'dias',
        'pago_entrega'
    ];
}
