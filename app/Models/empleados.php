<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\roles;
use App\Models\entregas;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class empleados extends Model
{
    use HasFactory;
    protected $table = "empleados";
    public $timestamps = false;
    protected $fillable =[
        'nombre',
        'vales',
        'id_rol'
    ];

    protected $with = ['rol', 'entrega'];
    public function rol(): BelongsTo{
        return $this->belongsTo(roles::class, 'id_rol');
    }
    
    public function entrega(): HasMany{
        return $this->hasMany(entregas::class, 'id_empleado');
    }

}
