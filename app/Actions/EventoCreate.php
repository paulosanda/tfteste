<?php

namespace App\Actions;

use App\Models\Evento;
use Illuminate\Http\Request;
use App\Traits\SanitizeTrait;

class EventoCreate extends BaseAction
{
    use SanitizeTrait;

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

        $data = $this->sanitizeData($request->all());

        return Evento::create($data);
    }
}
