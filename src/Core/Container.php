<?php

namespace MuharremYildirim\HajansTestCase\Core;

use DI\Container as DIContainer;
use DI\ContainerBuilder;

class Container
{
    private static DIContainer $instance;

    /**
     * build
     *
     * @return void
     */
    public function build(): void
    {
        $builder = new ContainerBuilder();
        self::$instance = $builder->build();
    }

    /**
     * instance
     *
     * @return DIContainer
     */
    public static function instance()
    {
        return self::$instance;
    }
}
