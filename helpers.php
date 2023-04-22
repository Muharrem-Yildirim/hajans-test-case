<?php

function array_except($input, $keys)
{
    $result = array_diff_key($input, array_flip($keys));
    return $result;
}

function config($key)
{
    $config = require __DIR__ . '/src/config.php';

    return $config[$key];
}

function unsetNulls($array)
{
    foreach ($array as $key => $value) {
        if (is_null($value)) {
            unset($array[$key]);
        }
    }

    return $array;
}

function env($key)
{
    if (array_key_exists($key, $_ENV)) {
        return $_ENV[$key];
    }

    return null;
}

function exceptionMessage($e)
{
    return config('debug') ? $e->getMessage() : 'Something went wrong.';
}
