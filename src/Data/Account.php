<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data;

use DateTimeImmutable;
use Dyrynda\Annature\Enum\Role;

final readonly class Account
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public string $number,
        public string $timezone,
        public Role $role,
        public bool $active,
        public ?string $groupId,
        public string $organisationId,
        public DateTimeImmutable $created,
        public DateTimeImmutable $verified,
    ) {
    }
}
