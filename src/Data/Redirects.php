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

    public static function fromArray(array $redirects): self
    {
        return new self(
            sessionCompleted: $redirects['session_completed'],
            sessionDeclined: $redirects['session_declined'],
        );
    }
}
