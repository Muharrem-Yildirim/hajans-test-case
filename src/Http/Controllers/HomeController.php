<?php

namespace MuharremYildirim\HajansTestCase\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function index(Response $response)
    {
        return $response->setContent(file_get_contents(__DIR__ . '../../../views/home.php'));
    }
}
