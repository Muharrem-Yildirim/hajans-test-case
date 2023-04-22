<?php

use MuharremYildirim\HajansTestCase\App;
use MuharremYildirim\HajansTestCase\Core\Logger;
use MuharremYildirim\HajansTestCase\Core\Container;

require_once __DIR__ . '/boot.php';

try {
    (new App())->run();
} catch (Throwable $e) {
    http_response_code(500);
    echo exceptionMessage($e);

    Container::instance()->get(Logger::class)->get()->error($e);
}
