<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventoTest extends TestCase
{
    use RefreshDatabase;
    public function test_create_evento(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador do evento de teste',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $this->assertDatabaseHas('eventos', [
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador do evento de teste',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);
    }
}
