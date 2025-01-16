<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breakdown extends Model
{
    use HasFactory;

    protected $table = 'breakdowns';
    protected $primaryKey = 'idAveria'; 
    public $timestamps = true;

}
