<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';
    protected $primaryKey = 'idSeccion';
    public $timestamps = true;

    protected $fillable = [
        'idSeccion', 
        'nombre',
     
    ];

    public static function generarIdSeccion($campus)
    {
        $ultimaSeccion = self::where('idSeccion', 'like', "$campus%")
            ->orderBy('idSeccion', 'desc')
            ->first();

        $ultimoNumero = $ultimaSeccion
            ? (int)substr($ultimaSeccion->idSeccion, 1)
            : 0;

        $nuevoNumero = str_pad($ultimoNumero + 1, 3, '0', STR_PAD_LEFT);

        return $campus . $nuevoNumero;
    }
}
