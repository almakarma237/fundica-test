<?php

declare(strict_types=1);

namespace user\infrastructure;

use user\application\query\FindUsers;
use Database;
use mysqli;

class MySqlFindUsers implements FindUsers
{
    private mysqli $connection;
    public function __construct(Database $database)
    {
        $this->connection = $database->getConnection();
    }
}
