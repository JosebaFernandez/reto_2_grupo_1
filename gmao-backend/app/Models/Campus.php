<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    protected $table = 'campuses';
    protected $primaryKey = 'idCampus';
    public $timestamps = true;

    public function machines()
    {
        return $this->hasMany(Machine::class, 'idCampus', 'idCampus');
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'idCampus', 'idCampus');
    }
}
