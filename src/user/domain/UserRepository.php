<?php

namespace user\domain;

interface UserRepository
{
    public function findById(string $id): User;

    public function store(User $payload): string;
}
