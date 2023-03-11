<?php

namespace App\Swagger;

/**
 * @OA\Schema(
 *     title="EventoRequest",
 *     description="Modelo de evento",
 *     @OA\Xml(
 *         name="EventoRequest"
 *     )
 * )
 */
class EventoRequest
{

    /**
     * @OA\Property(
     *     property="nome_do_evento",
     *     description="Nome do evento",
     *     type="string",
     *     example="Festa de Aniversário"
     * )
     *
     * @var string
     */
    public $nome_do_evento;

    /**
     * @OA\Property(
     *     property="nome_do_patrocinador",
     *     description="Nome do patrocinador do evento",
     *     type="string",
     *     example="Empresa XYZ"
     * )
     *
     * @var string
     */
    public $nome_do_patrocinador;

    /**
     * @OA\Property(
     *     property="data_do_evento",
     *     description="Data do evento",
     *     type="string",
     *     format="date",
     *     example="2023-04-22"
     * )
     *
     * @var string
     */
    public $data_do_evento;

    /**
     * @OA\Property(
     *     property="data_de_criacao",
     *     description="Data de criação do evento",
     *     type="string",
     *     format="date-time",
     *     example="2023-03-11"
     * )
     *
     * @var string
     */
    public $data_de_criacao;

    /**
     * @OA\Property(
     *      property="nome_do_artista",
     *      description="Nome do artista",
     *      type="string",
     *      example="Caetano",
     * )
     * @var string
     */
    public $nome_do_artista;

    /**
     * @OA\Property(
     *      property="horario_de_inicio",
     *      description="Horario de Inicio",
     *      type="datetime",
     *      format="datetime",
     *      example="10:00"
     * )
     * @var string
     */
    public $horario_de_inicio;

    /**
     * @OA\Property(
     *      property="local",
     *      description="Local do evento",
     *      type="string",
     *      example="Salão de festas"
     * )
     * @var string
     */
    public $local;

    /**
     * @OA\Property(
     *      property="duracao",
     *      description="Duracao do evento",
     *      type="integer",
     *      example="3"
     * )
     * @var integer
     */
    public $duracao;

    /**
     * @OA\Property(
     *      property="lotacao_maxima",
     *      description="Lotação máxima para o evento",
     *      type="integer",
     *      example="1000"
     * )
     * @var integer
     */
    public $lotacao_maxima;
}
