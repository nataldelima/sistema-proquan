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
        'grupos_de_campo_id'
    ];

    protected $casts = [
        'privilegios' => 'array',
        'ativo' => 'boolean',
        'contatoEmergenciaEhTj' => 'boolean'
    ];

    public function grupoDeCampo()
    {
        return $this->belongsTo(GruposDeCampo::class, 'grupos_de_campo_id');
    }
}
