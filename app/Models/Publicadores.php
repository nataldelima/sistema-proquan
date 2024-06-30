<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicadores extends Model
{
    use HasFactory;

    protected $table = 'publicadores';
    protected $fillable = [
        'primeiroNome',
        'nomeMeio',
        'sobrenome',
        'dataNascimento',
        'dataBatismo',
        'sexo',
        'privilegios',
        'gruposdecampo_id',
        'endereco',
        'telefone',
        'contatoEmergencia',
        'telContatoEmergencia',
        'contatoEmergenciaEhTj',
        'ativo',
    ];

    public function grupoDeCampo()
    {
        return $this->belongsTo(GruposDeCampo::class, 'gruposdecampo_id');
    }
}

