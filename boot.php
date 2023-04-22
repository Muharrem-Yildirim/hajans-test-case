<?php

use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';
require_once  __DIR__ . '/helpers.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
