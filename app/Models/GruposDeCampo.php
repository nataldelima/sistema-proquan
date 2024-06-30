<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GruposDeCampo extends Model
{

    use HasFactory;

    protected $table = 'grupos_de_campo';

    protected $fillable = [
        'nome',
        'congregacao_id',
        'dirigente_id',
        'ajudante_id',
    ];

    public function congregacao()
    {
        return $this->belongsTo(Congregacao::class);
    }

    public function dirigente()
    {
        return $this->belongsTo(Publicadores::class, 'dirigente_id');
    }

    public function ajudante()
    {
        return $this->belongsTo(Publicadores::class, 'ajudante_id');
    }
}
