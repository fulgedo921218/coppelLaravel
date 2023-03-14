<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\empleados;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class entregas extends Model
{
    use HasFactory;
    protected $table = "entregas";
    public $timestamps = false;
    protected $fillable =[
        'id_empleado',
        'entregas',
        'pago_total',
        'fecha_entrega',
    ];
    
}
