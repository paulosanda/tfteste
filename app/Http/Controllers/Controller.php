<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *  title="API Eventos - Teste Trocafone",
 *  version="1.0.0",
 *  description="API de Gestão de Eventos",
 *  @OA\Contact(
 *      email="paulosanda@gmail.com",
 *      name="Paulo Sanda"
 *  )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
