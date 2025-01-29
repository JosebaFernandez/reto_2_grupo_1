<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'idTarea';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'descripcion',
        'habilitada'
    ];
}
