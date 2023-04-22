<?php

namespace MuharremYildirim\HajansTestCase\Core;

class MySQL
{
    protected $connection = null;

    public function __construct()
    {
        $this->connection = $this->connect();
    }

    public function connect()
    {
        $db = new \PDO(config('db_connection_string'), config('db_username'), config('db_password'));
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        $db->setAttribute(\PDO::MYSQL_ATTR_FOUND_ROWS, true);
        $db->exec('SET NAMES utf8');

        return $db;
    }
}
