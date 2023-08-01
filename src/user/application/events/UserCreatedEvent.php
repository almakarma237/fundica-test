<?php

declare(strict_types=1);

namespace user\application\events;

use _lib\events\Event;
use user\domain\User;


class UserCreatedEvent extends Event
{
    private User $user;
    public const TOPIC = 'User';
    public const EVENT_TYPE = 'UserCreatedEvent';

    public function __construct(User $user)
    {
        $this ->setName('UserCreatedEvent');
        $this ->setTarget($user);
    }

    public function __invoke(): User
    {
        return parent::getTarget();
    }
}