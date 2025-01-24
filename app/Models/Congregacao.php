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


    public function getTelefoneSupteCircuitoFormattedAttribute()
    {
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $this->telefoneSupteCircuito);
    }
}
