<?php

namespace App\Actions;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Traits\SanitizeTrait;

class EventoUpdate extends BaseAction
{
    use SanitizeTrait;

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

        $data = $this->sanitizeData($request->all());

        if ($data['data_do_evento'] >= $evento->data_de_criacao) {
            $data = Arr::except($data, ['nome_do_evento', 'data_de_criacao']);
            $evento->fill($data);
            $evento->save();

            return $evento;
        } else {
            return "A data do evento não pode ser anterior a data de criação";
        }
    }
}
