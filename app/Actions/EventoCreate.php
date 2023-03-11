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

        $sanitizedData = [];
        foreach ($request->all() as $key => $value) {
            if (is_string($value)) {
                $sanitizedData[$key] = trim(strip_tags($value));
            } else {
                $sanitizedData[$key] = $value;
            }
        }

        return Evento::create($sanitizedData);
    }
}
