<?php

namespace user\infrastructure;
use Database;

class UserCollection
{
    
    private $connection;
    public function __construct(Database $database)
    {
        $this->connection = $database->getConnection();
        $this->initUserCollection();
    }

    private function initUserCollection(): void
    {
        // sql to create table
        $sql =
        "CREATE TABLE IF NOT EXISTS `user` (
            `id` int NOT NULL AUTO_INCREMENT,
            `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `published_at` datetime DEFAULT NULL,
            `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `deleted` tinyint(1) NOT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `version` int NOT NULL,
            PRIMARY KEY (`id`)
           ) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        if ($this->connection->query($sql) === TRUE) {
           // echo "Table User created successfully";
        } else {
           // echo "Error creating table: " . $this->connection->error;
        }
    }

}


