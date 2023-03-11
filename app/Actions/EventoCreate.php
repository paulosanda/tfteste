<?php

namespace App\Actions;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoCreate extends BaseAction
{

    public function rules()
    {
        return [
            'nome_do_evento' => 'required|string|min:5|max:30',
            'nome_do_patrocinador' => 'required|string|min:5|max:30',
            'data_do_evento' => 'required|date|after_or_equal:data_de_criacao',
            'data_de_criacao' => 'required|date',
            'local' => 'required',
            'nome_do_artista' => 'required|string|min:5|max:30',
            'horario_de_inicio' => 'required|date_format:H:i',
            'duracao' => 'required|integer|max:5',
            'lotacao_maxima' => 'required|integer',
        ];
    }

    public function execute(Request $request)
    {
        $this->validate($request);

        return Evento::create([
            'nome_do_evento' => $request['nome_do_evento'],
            'nome_do_patrocinador' => $request['nome_do_patrocinador'],
            'data_do_evento' => $request['data_do_evento'],
            'data_de_criacao' => $request['data_de_criacao'],
            'local' => $request['local'],
            'nome_do_artista' => $request['nome_do_artista'],
            'horario_de_inicio' => $request['horario_de_inicio'],
            'duracao' => $request['duracao'],
            'lotacao_maxima' => $request['lotacao_maxima'],
        ]);
    }
}
