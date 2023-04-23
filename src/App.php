<?php

namespace MuharremYildirim\HajansTestCase;

use MuharremYildirim\HajansTestCase\Http\Routes;
use MuharremYildirim\HajansTestCase\Core\Container;

class App
{
    /**
     * run
     *
     * @return void
     */
    public function run(): void
    {
        (new Container())->build();
        (new Routes())->initRoutes();
    }
}
