<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'maintenances';
    protected $primaryKey = 'idMantenimiento';
    public $timestamps = true;

    protected $fillable = [
        'idTarea',
        'idMaquina',
        'frecuencia',
        'ultimoMantenimiento',
        'proximoMantenimiento'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'idTarea', 'idTarea');
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class, 'idMaquina', 'idMaquina');
    }
}
