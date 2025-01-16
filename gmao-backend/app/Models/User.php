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
}
