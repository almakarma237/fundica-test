<?php

declare(strict_types=1);

namespace user\application\useCases;

use user\application\events\UserCreatedEvent;
use _lib\events\EventManager;
use user\domain\User;
use user\domain\UserProps;
use user\domain\UserRepository;

class CreateUser
{
    private UserRepository $userRepository;
    private EventManager $eventManager;

    public function __construct( EventManager $eventManager, UserRepository $userRepository,
    ) {
        $this->eventManager = $eventManager;
        $this->userRepository = $userRepository;
    }

    public function __invoke(CreateUserPayload $payload): string
    {
        $user = new User(
            null,
            $payload->email,
            $payload->phoneNumber,
            $payload->firstName,
            $payload->lastName,
            $payload->postalCode
        );

        $user->setId($this->userRepository->store($user));

        $userEvent = new UserCreatedEvent($user);

        $this->eventManager->trigger($userEvent);

        return $user->getId();
    }
}

class CreateUserPayload
{
    public ?string $email;
    public ?string $phoneNumber;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $postalCode;

    public function __construct(
        ?string $email = null,
        ?string $phoneNumber = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $postalCode = null
        )
    {
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->postalCode = $postalCode;
    }
}
