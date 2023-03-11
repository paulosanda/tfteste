<?php

namespace App\Http\Controllers;

use App\Actions\EventoCreate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Actions\EventoSearch;
use App\Models\Evento;
use App\Actions\EventoUpdate;

/**
 * @OA\Get(
 *     path="/api/evento",
 *     summary="Obter todos os eventos",
 *     tags={"Evento"},
 *     @OA\Response(
 *         response="200",
 *         description="Retorna uma lista de eventos",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Evento")),
 *     ),
 *     @OA\Response(
 *         response="500",
 *         description="Erro interno do servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Erro ao processar a solicitação.")
 *         )
 *     )
 * )
 */




class EventoController extends Controller
{


    public function index(): JsonResponse
    {
        $response = Evento::all();

        return response()->json($response);
    }

    /**
     * @OA\Post(
     *     path="/api/evento",
     *     summary="Criar um novo evento",
     *     tags={"Evento"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do evento",
     *         @OA\JsonContent(ref="#/components/schemas/Evento")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Evento criado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Evento")
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Erro na validação dos dados",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Erro ao validar os dados.")
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Erro interno do servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Erro ao processar a solicitação.")
     *         )
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $store = app(EventoCreate::class)->execute($request);

        return response()->json($store);
    }

    /**
     * @OA\Get(
     *     path="/api/evento/{id}",
     *     operationId="evento.show",
     *     tags={"Evento"},
     *     summary="Mostrar detalhes do evento",
     *     description="Retorna os detalhes do evento especificado pelo ID",
     *     @OA\Parameter(
     *         name="id",
     *         description="ID do evento",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes do evento",
     *         @OA\JsonContent(ref="#/components/schemas/Evento")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Evento não encontrado"
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        $response = Evento::find($id);

        return response()->json($response);
    }

    /**
     * @OA\Put(
     *     path="/api/evento/{id}",
     *     operationId="evento.update",
     *     tags={"Evento"},
     *     summary="Atualizar um evento",
     *     description="Atualiza um evento especificado pelo ID",
     *     @OA\Parameter(
     *         name="id",
     *         description="ID do evento",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Informações do evento",
     *         @OA\JsonContent(ref="#/components/schemas/EventoRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Evento atualizado",
     *         @OA\JsonContent(ref="#/components/schemas/Evento")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Evento não encontrado"
     *     )
     * )
     */
    public function update(Request $request, $id): JsonResponse
    {
        $response = app(EventoUpdate::class)->execute($request, $id);

        return response()->json($response);
    }

    /**
     * @OA\Delete(
     *     path="/api/evento/{id}",
     *     summary="Deletar um evento",
     *     description="Deleta um evento pelo seu ID.",
     *     operationId="deleteEvento",
     *     tags={"Evento"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do evento a ser deletado",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Evento deletado com sucesso."
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Evento não encontrado."
     *     )
     * )
     */
    public function delete($id)
    {
        $response = Evento::where('id', $id)->delete();

        return response()->json($response);
    }
}
