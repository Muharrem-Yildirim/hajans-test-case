<?php

namespace MuharremYildirim\HajansTestCase\Core;

use Monolog\Level;
use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;

class Logger
{
    private MonologLogger $logger;

    /**
     * get
     *
     * @return MonologLogger
     */
    public function get(): MonologLogger
    {
        if (isset($this->logger)) {
            return $this->logger;
        }

        $this->logger = new MonologLogger('main');
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/error.log', Level::Error));

        return $this->logger;
    }
}
