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

    public static function fromArray(array $account): self
    {
        return new self(
            id: $account['id'],
            name: $account['name'],
            email: $account['email'],
            number: $account['number'],
            timezone: $account['timezone'],
            role: Role::from($account['role']),
            active: $account['active'],
            groupId: $account['group_id'],
            organisationId: $account['organisation_id'],
            created: DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $account['created']),
            verified: DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $account['verified']),
        );
    }
}
