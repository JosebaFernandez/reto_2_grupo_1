<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
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
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Usualmente es el ID del usuario
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
