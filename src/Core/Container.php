<?php

namespace MuharremYildirim\HajansTestCase\Core;

use DI\ContainerBuilder;

class Container
{
    private static $instance = null;

    public function build()
    {
        $builder = new ContainerBuilder();
        self::$instance = $builder->build();
    }

    public static function instance()
    {
        return self::$instance;
    }
}
