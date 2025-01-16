<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $table = 'machines';
    protected $primaryKey = 'idMaquina';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'idCampus',
        'idSeccion',
        'prioridad'
    ];

    public function campus()
    {
        return $this->belongsTo(Campus::class, 'idCampus', 'idCampus');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'idSeccion', 'idSeccion');
    }
}