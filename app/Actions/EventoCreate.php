<?php

namespace App\Actions;

use App\Models\Evento;

class EventoCreate extends BaseAction
{
    public function execute(array $data)
    {
        $rules = [
            'nome_do_evento' => 'required',
            'nome_do_patrocinador',
            'data_do_evento',
            'data_de_criacao',
            'local',
            'nome_do_artista',
            'horario_de_inicio',
            'duracao',
            'lotacao_maxima',
        ];

        $messages = [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'Este endereço de e-mail já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
            'password.confirmed' => 'As senhas não correspondem.',
        ];

        $this->validate($data, $rules, $messages);

        return Evento::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
