<?php

namespace MuharremYildirim\HajansTestCase\Http\Middlewares;

use Buki\Router\Http\Middleware;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BasicAuthenticationMiddleware extends Middleware
{
    /**
     * handle
     *
     * @param  Request $request
     * @return bool|JsonResponse
     */
    public function handle(Request $request): bool|JsonResponse
    {
        if (str_replace('Bearer ', '', $request->headers->get('authorization')) != config('api_key') || empty(config('api_key'))) {
            return new JsonResponse([
                'error' => true,
                'message' => 'Unauthorized.'
            ], 401);
        }

        return true;
    }
}
