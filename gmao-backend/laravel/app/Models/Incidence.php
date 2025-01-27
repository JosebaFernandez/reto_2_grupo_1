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
        'titulo',
        'descripcion',
        'fechaResolucion',
        'estadoIncidencia',
        'habilitada',
        'gravedad',
        'idAveria'
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class, 'idMaquina', 'idMaquina');
    }

    public function breakdown()
    {
        return $this->hasOne(Breakdown::class, 'idAveria', 'idAveria');
    }
}
