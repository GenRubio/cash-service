<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    title="Cash Service API",
 *    version="1.0.0",
 *    description="Cash MicroService - Swagger"
 * ),
 * @OA\Server(
 *    description="Local server",
 *    url="/api/v1/"
 * ),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
