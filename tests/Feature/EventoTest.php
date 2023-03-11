<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Evento;

class EventoTest extends TestCase
{
    use RefreshDatabase;
    public function test_create_evento(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador do evento',
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
            'nome_do_patrocinador' => 'Patrocinador do evento',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);
    }

    public function test_create_evento_with_validade_error_nome_do_evento_void(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $response = $this->post(route('evento.add'), [

            'nome_do_patrocinador' => 'Patrocinador do evento',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The nome do evento field is required.'
        ]);
    }

    public function test_create_evento_with_validade_error_nome_do_evento_minor(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $response = $this->post(route('evento.add'), [
            'nome_do_evento' => 'eve',
            'nome_do_patrocinador' => 'Patrocinador do evento',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The nome do evento field must be at least 5 characters.'
        ]);
    }

    public function test_create_evento_with_validade_error_nome_do_evento_bigger(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $response = $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento com nome muito grande não serão aceitos no cadastro',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The nome do evento field must not be greater than 30 characters. (and 1 more error)'
        ]);
    }

    public function test_create_evento_with_validade_error_nome_do_patrocinador_void(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $response = $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The nome do patrocinador field is required.',
        ]);
    }

    public function test_create_evento_with_validade_error_nome_do_patrocinador_minor(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $response = $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento',
            'nome_do_patrocinador' => 'Pa',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The nome do patrocinador field must be at least 5 characters.',
        ]);
    }

    public function test_create_evento_with_validade_error_nome_do_patrocinador_bigger(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $response = $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento',
            'nome_do_patrocinador' => 'Nome do patrocinador não pode ser maior que 30 caracteres',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The nome do patrocinador field must not be greater than 30 characters.',
        ]);
    }

    public function test_create_evento_with_validade_error_data_do_evento_void(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $response = $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento',
            'nome_do_patrocinador' => 'Nome do patrocinador',
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The data do evento field is required.',
        ]);
    }

    public function test_create_evento_with_validade_error_data_do_evento_before(): void
    {
        $data_criacao = date('Y-m-d H:i', strtotime('+10 days'));

        $data_evento = date('Y-m-d H:i');

        $response = $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento',
            'nome_do_patrocinador' => 'Nome do patrocinador',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The data do evento field must be a date after or equal to data de criacao.',
        ]);
    }

    public function test_create_evento_error_data_de_criacao_void(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $response = $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador do evento',
            'data_do_evento' => $data_evento,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The data de criacao field is required.',
        ]);
    }

    public function test_create_evento_error_data_de_criacao_string(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $response = $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador do evento',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => '$data_criacao',
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The data de criacao field must be a valid date.',
        ]);
    }

    public function test_create_evento_error_local_void(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $response = $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador do evento',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The local field is required.',
        ]);
    }

    public function test_create_evento_error_nome_do_artista_void(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $response = $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador do evento',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The nome do artista field is required.',
        ]);
    }

    public function test_create_evento_error_horario_de_inicio_void(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $response = $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador do evento',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            //'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The horario de inicio field is required.',
        ]);
    }

    public function test_create_evento_error_horario_de_inicio_string(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $response = $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador do evento',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => 'horario',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The horario de inicio field must match the format H:i.',
        ]);
    }

    public function test_create_evento_error_duracao_bigger(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $response = $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador do evento',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '05:00',
            'duracao' => 10,
            'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The duracao field must not be greater than 5.',
        ]);
    }

    public function test_create_evento_error_lotacao_void(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $response = $this->post(route('evento.add'), [
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador do evento',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '05:00',
            'duracao' => 3,
            //'lotacao_maxima' => 1000,
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'messages' => 'The lotacao maxima field is required.',
        ]);
    }

    public function teste_evento_index(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        Evento::create([
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador do evento',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $this->get(route('evento.index'))->assertOk();
    }

    public function test_evento_show(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $evento = Evento::create([
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador do evento',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $this->get(route('evento.index', $evento->id))->assertOk();
    }

    public function test_evento_edit(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $evento = Evento::create([
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador do evento',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $data_criacao_novo = \DateTime::createFromFormat('Y-m-d H:i', $data_criacao);
        $data_criacao_novo->modify('+1 day');
        $data_criacao_novo = $data_criacao_novo->format('Y-m-d H:i');

        $data_evento_novo = \DateTime::createFromFormat('Y-m-d H:i', $data_evento);
        $data_evento_novo->modify('+1 day');
        $data_evento_novo = $data_evento_novo->format('Y-m-d H:i');

        $this->put(route('evento.update', $evento->id), [
            'nome_do_evento' => 'Evento alterado',
            'nome_do_patrocinador' => 'Patrocinador alterado',
            'data_do_evento' => $data_evento_novo,
            'data_de_criacao' => $data_criacao_novo,
            'local' => 'Lugar alterado',
            'nome_do_artista' => 'artista',
            'horario_de_inicio' => '11:00',
            'duracao' => 4,
            'lotacao_maxima' => 100,
        ]);

        $this->assertDatabaseHas('eventos', [
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador alterado',
            'data_do_evento' => $data_evento_novo,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar alterado',
            'nome_do_artista' => 'artista',
            'horario_de_inicio' => '11:00',
            'duracao' => 4,
            'lotacao_maxima' => 100,
        ]);
    }

    public function test_evento_delete(): void
    {
        $data_criacao = date('Y-m-d H:i');

        $data_evento = date('Y-m-d H:i', strtotime('+10 days'));

        $evento = Evento::create([
            'nome_do_evento' => 'Evento de teste',
            'nome_do_patrocinador' => 'Patrocinador do evento',
            'data_do_evento' => $data_evento,
            'data_de_criacao' => $data_criacao,
            'local' => 'Lugar onde acontecera o evento',
            'nome_do_artista' => 'Nome do artista',
            'horario_de_inicio' => '10:00',
            'duracao' => 2,
            'lotacao_maxima' => 1000,
        ]);

        $this->delete(route('evento.delete', $evento->id));
        $this->assertDatabaseCount('eventos', 0);
    }
}
