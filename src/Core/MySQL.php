<?php

namespace MuharremYildirim\HajansTestCase\Core;

class MySQL
{
    protected \PDO $connection;

    public function __construct()
    {
        $this->connection = $this->connect();
    }

    /**
     * connect
     *
     * @return PDO
     */
    public function connect(): \PDO
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
