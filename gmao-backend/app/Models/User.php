<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'idUsuario';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'apellido',
        'rol',
        'email',
        'password',
        'habilitado'
    ];

    protected $hidden = [
        'password'
    ];

    protected static function booted()
    {
        static::creating(function ($user) {
            if (is_null($user->habilitado)) {
                $user->habilitado = 1;
            }
        });
    }
}
