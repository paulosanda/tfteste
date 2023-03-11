<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_do_evento',
        'nome_do_patrocinador',
        'data_do_evento',
        'data_de_criacao',
        'local',
        'nome_do_artista',
        'horario_de_inicio',
        'duracao',
        'lotacao_maxima',
    ];

    protected $guarded = ['nome_do_evento', 'data_criacao'];
}
