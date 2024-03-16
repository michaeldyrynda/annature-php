<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data;

final readonly class Redirects extends Data
{
    public function __construct(
        public ?string $sessionCompleted,
        public ?string $sessionDeclined,
    ) {
    }

    public static function fromArray(array $properties): static
    {
        return new self(
            sessionCompleted: $properties['session_completed'],
            sessionDeclined: $properties['session_declined'],
        );
    }
}
