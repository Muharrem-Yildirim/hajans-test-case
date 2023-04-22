<?php

namespace MuharremYildirim\HajansTestCase;

use Dotenv\Dotenv;
use DI\ContainerBuilder;
use MuharremYildirim\HajansTestCase\Http\Routes;
use MuharremYildirim\HajansTestCase\Core\Container;

class App
{
    public function run()
    {
        (new Container())->build();
        (new Routes())->initRoutes();
    }
}
