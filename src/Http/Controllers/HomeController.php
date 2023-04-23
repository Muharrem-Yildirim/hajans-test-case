<?php

namespace MuharremYildirim\HajansTestCase\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    /**
     * index
     *
     * @param  Response $response
     * @return Response
     */
    public function index(Response $response): Response
    {
        return $response->setContent(file_get_contents(__DIR__ . '../../../views/home.php'));
    }
}
