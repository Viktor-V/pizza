<?php

declare(strict_types=1);

namespace App\Pizza\Domain\Type;

class Name
{
    public function __construct(
        private string $name
    ) {
    }

    public function __toString()
    {
        return $this->name;
    }
}
