<?php

namespace _lib\cqrs;

class Sort
{
    private string $field;
    private string $direction;

    public function __construct(?string $field, ?string $direction)
    {
        $this->field = $field;
        $this->direction = $direction;
    }

    public function field()
    {
        return $this->field;
    }

    public function direction()
    {
        return $this->direction;
    }
}