<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    protected $table = 'interventions';
    protected $primaryKey = 'idIntervencion';
    public $timestamps = true;

    protected $fillable = [
        'idTecnico',
        'idIncidencia',
        'fechaInicio',
        'fechaFin',
        'notas'
    ];

    public function tecnico()
    {
        return $this->belongsTo(User::class, 'idTecnico', 'idUsuario');
    }

    public function incidencia()
    {
        return $this->belongsTo(Incidence::class, 'idIncidencia', 'idIncidencia');
    }
}
