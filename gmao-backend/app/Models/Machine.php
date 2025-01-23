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
        'idMaquina',
        'habilitada',
        'nombre',
        'idCampus',
        'idSeccion',
        'prioridad'
    ];

    public static function generarIdMaquina($campus)
    {
        $ultimaMaquina = self::where('idMaquina', 'like', "$campus%")
            ->orderBy('idMaquina', 'desc')
            ->first();

        $ultimoNumero = $ultimaMaquina
            ? (int)substr($ultimaMaquina->idMaquina, strlen($campus))
            : 0;

        $nuevoNumero = str_pad($ultimoNumero + 1, 6, '0', STR_PAD_LEFT);

        return $campus . $nuevoNumero;
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class, 'idCampus', 'idCampus');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'idSeccion', 'idSeccion');
    }
}
