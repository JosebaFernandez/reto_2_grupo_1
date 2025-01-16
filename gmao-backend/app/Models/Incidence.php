<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidence extends Model
{
    use HasFactory;

    protected $table = 'incidences';
    protected $primaryKey = 'idIncidencia';
    public $timestamps = true;

    protected $fillable = [
        'idMaquina',
        'fechaReporte',
        'descripcion',
        'fechaResolucion',
        'estadoIncidencia',
        'prioridad',
        'estadoMaquina',
        'habilitado'
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class, 'idMaquina', 'idMaquina');
    }
}
