<?php

declare(strict_types=1);

namespace user\infrastructure;

use user\domain\User;
use user\domain\State;
use user\infrastructure\UserSchema;
use DateTime;

class UserMapper
{
    public static function toData(User $entity): UserSchema
    {
        return UserSchema::toSchema(
            $entity->getId(),
            $entity->getEmail(),
            $entity->getPhoneNumber(),
            $entity->getFirstName(),
            $entity->getLastName(),
            $entity->getPostalCode(),
            $entity->getPublishedAt(),
            $entity->getState()->value,
            $entity->getState()->value === 'DELETED',
            $entity->getCreatedAt(),
            $entity->getUpdatedAt(),
            $entity->getVersion()
        );
    }

    public static function toEntity(array $data): User
    {
        return User::toUser(
            $data['id'],
            $data['email'],
            $data['phone_number'],
            $data['first_name'],
            $data['last_name'],
            $data['postal_code'],
            State::from($data['status']),
            isset($data['published_at'])? new DateTime($data['published_at']): null,
            new DateTime($data['created_at']),
            new DateTime($data['updated_at']),
            intval($data['version']),
        );
    }
}
