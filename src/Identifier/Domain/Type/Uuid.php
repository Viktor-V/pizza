<?php

declare(strict_types=1);

namespace App\Identifier\Domain\Type;

class Uuid
{
    public function __construct(
        private ?string $uuid = null
    ) {
        if ($uuid === null) {
            $this->uuid = (string) \Symfony\Component\Uid\Uuid::v4();
        }
    }

    public function __toString(): string
    {
        return $this->uuid;
    }
}
