<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data;

use DateTimeImmutable;
use Dyrynda\Annature\Enum\Role;

final readonly class Account extends Data
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

    public static function fromArray(array $properties): static
    {
        return new self(
            id: $properties['id'],
            name: $properties['name'],
            email: $properties['email'],
            number: $properties['number'],
            timezone: $properties['timezone'],
            role: Role::from($properties['role']),
            active: $properties['active'],
            groupId: $properties['group_id'],
            organisationId: $properties['organisation_id'],
            created: DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['created']),
            verified: DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['verified']),
        );
    }
}
