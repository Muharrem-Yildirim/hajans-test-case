<?php

namespace MuharremYildirim\HajansTestCase\Setup;

use MuharremYildirim\HajansTestCase\Core\MySQL;

require_once __DIR__ . '/../../boot.php';

class Setup extends MySQL
{
    public function __construct()
    {
        if (!$this->isCli()) die('This script can only be run from the command line');

        parent::__construct();

        $this->importSql();
    }

    /**
     * isCli
     *
     * @return bool
     */
    public static function isCli(): bool
    {
        return php_sapi_name() === 'cli';
    }

    /**
     * importSql
     *
     * @return void
     */
    public function importSql(): void
    {
        $sql = file_get_contents(__DIR__ . '/schema.sql');
        $this->connection->exec($sql);
    }
}

new Setup();
