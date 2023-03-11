<?php

namespace App\Actions;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoUpdate extends BaseAction
{

    public function rules()
    {
        return [
            'nome_do_patrocinador' => 'string|min:5|max:30',
            'data_do_evento' => 'date|after_or_equal:data_de_criacao',
            'local' => 'string',
            'nome_do_artista' => 'string|min:5|max:30',
            'horario_de_inicio' => 'date_format:H:i',
            'duracao' => 'integer|max:5',
            'lotacao_maxima' => 'integer',
        ];
    }

    public function execute(Request $request, $id)
    {
        $this->validate($request);

        $evento = Evento::findOrFail($id);
        if ($request->data_do_evento >= $evento->data_de_criacao) {
            $data = $request->except(['nome_do_evento', 'data_de_criacao']);
            $evento->fill($data);
            $evento->save();

            return $evento;
        } else {
            return "A data do evento não pode ser anterior a data de criação";
        }
    }
}
