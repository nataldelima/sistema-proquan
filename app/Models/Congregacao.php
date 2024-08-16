<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Congregacao extends Model
{
    use HasFactory;

    protected $table = 'congregacao';
    protected $fillable = [
        'id',
        'nome',
        'endereco',
        'circuito',
        'supteCircuito',
        'telefoneSupteCircuito',
    ];
}
