<?php

declare(strict_types=1);

namespace user\infrastructure;

use user\domain\User;
use user\domain\UserRepository;

use Database;
use ErrorException;
use mysqli;

class MySqlUserRepository implements UserRepository
{
    private mysqli $connection;
    public function __construct(Database $database)
    {
        $this->connection = $database->getConnection();
    }


    public function findById(string $id): User
    {
        $sql = "SELECT * FROM user WHERE `id` ='$id' AND 'deleted' = 0";
        $result = $this->connection->query($sql);
        $user = [];

        if (!$result->num_rows > 0) {
            throw new ErrorException("Not Found", 404);
        }
        // OUTPUT DATA OF EACH ROW
        while ($row = $result->fetch_assoc()) {
            $user = UserMapper::toEntity($row);
        }

        return $user;
    }

    public function store(User $entity): string
    {
        $user = UserMapper::toData($entity);

        $id = $user->getId();
        $email = $user->getEmail();
        $phoneNumber = $user->getPhoneNumber();
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $postalCode = $user->getPostalCode();
        $status = $user->getStatus();
        $publishedAt = $user->getPublishedAt();
        $deleted = (string) $user->getDeleted();
        $version = $user->getVersion();

        $sql = "SELECT * FROM user WHERE `id` ='$id'";
        $result = $this->connection->query($sql);
        $count = $result->num_rows;

        if ($count) {
            $version++;

            $query =
                "UPDATE `user`
             SET
             `email`='$email',
             `phone_number`='$phoneNumber',
             `first_name`='$firstName',
             `last_name`='$lastName',
             `postal_code`='$postalCode',
             `status`='$status',
             `deleted`= '$deleted',
             `version`='$version'"
            ;

            if ($publishedAt) {
                $query .= ",`published_at`='$publishedAt'";
            }

            $query .= "WHERE `id` ='$id'";

            $result = $this->connection->query($query);
            return $id;
        }

        $query =
            "INSERT INTO `user`
            (
                email,
                phone_number,
                first_name,
                last_name,
                postal_code,
                status,
                deleted,
                version
            )
            VALUES
            (
                '$email',
                '$phoneNumber',
                '$firstName',
                '$lastName',
                '$postalCode',
                '$status',
                '$deleted',
                '$version'
            )";

        if (!$this->connection->query($query)) {
            throw new ErrorException();
        }
        return (string) $this->connection->insert_id;
    }

}