<?php

namespace MuharremYildirim\HajansTestCase\Http;

use Throwable;
use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use MuharremYildirim\HajansTestCase\Core\Container;
use MuharremYildirim\HajansTestCase\Http\Controllers\HomeController;
use MuharremYildirim\HajansTestCase\Http\Controllers\Api\ProductController;
use MuharremYildirim\HajansTestCase\Http\Controllers\Api\CategoryController;

class Routes
{
    /**
     * initRoutes
     *
     * @return void
     */
    public function initRoutes(): void
    {
        $router = new Router(
            [
                'paths' => [
                    'controllers' => 'src/Http/Controllers',
                    'middlewares' => 'src/Http/Middlewares',
                ],
                'namespaces' => [
                    'controllers' => 'MuharremYildirim\HajansTestCase\Http\Controllers',
                    'middlewares' => 'MuharremYildirim\HajansTestCase\Http\Middlewares',
                ],
            ]
        );

        $router->get('/', HomeController::class . '@index');

        $router->group('api', function ($router) {
            $router->get('/products', [ProductController::class, 'index']);
            $router->get('/products/:id', [ProductController::class, 'show']);
            $router->post('/products', [ProductController::class, 'post']);
            $router->put('/products/:id', [ProductController::class, 'put']);
            $router->delete('/products/:id', [ProductController::class, 'delete']);

            $router->get('/categories', [CategoryController::class, 'index']);
            $router->get('/categories/:id', [CategoryController::class, 'show']);
            $router->post('/categories', [CategoryController::class, 'post']);
            $router->put('/categories/:id', [CategoryController::class, 'put']);
            $router->delete('/categories/:id', [CategoryController::class, 'delete']);

            $router->notFound(function (Request $request, Response $response) {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Route not found.'
                ], 404);
            });
        });

        $router->error(function (Request $request, Response $response, Throwable $e) {
            $logger = Container::instance()->get(Logger::class);

            $logger->get()->error(json_encode($request->request->all()));
            $logger->get()->error($e);

            return new JsonResponse([
                'error' => true,
                'message' => exceptionMessage($e)
            ], 500);
        });

        $router->run();
    }
}
