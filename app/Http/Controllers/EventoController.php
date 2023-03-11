<?php

namespace App\Http\Controllers;

use App\Actions\EventoCreate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Actions\EventoSearch;
use App\Models\Evento;
use App\Actions\EventoUpdate;

class EventoController extends Controller
{
    public function index(Request $request)
    {
        $response = Evento::all();

        return response()->json($response);
    }
    public function store(Request $request): JsonResponse
    {
        $store = app(EventoCreate::class)->execute($request);

        return response()->json($store);
    }

    public function search(Request $request): JsonResponse
    {
        $response = app(EventoSearch::class)->execute($request);

        return response()->json($response);
    }

    public function show($id): JsonResponse
    {
        $response = Evento::find($id);

        return response()->json($response);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $response = app(EventoUpdate::class)->execute($request, $id);

        return response()->json($response);
    }

    public function delete($id)
    {
        $response = Evento::where('id', $id)->delete();

        return response()->json($response);
    }
}
