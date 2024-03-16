<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data;

use DateTimeImmutable;
use Dyrynda\Annature\Enum\RecipientStatus;
use Dyrynda\Annature\Enum\RecipientType;

final readonly class Recipient extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public ?string $mobile,
        public RecipientType $type,
        public RecipientStatus $status,
        public ?string $message,
        public bool $password,
        public bool $muted,
        public int $order,
        public ?string $declinedReason,
        public ?DateTimeImmutable $created,
        public ?DateTimeImmutable $sent,
        public ?DateTimeImmutable $declined,
        public ?DateTimeImmutable $completed,
        public Redirects $redirects,
    ) {
    }

    public static function fromArray(array $properties): static
    {
        return new self(
            id: $properties['id'],
            name: $properties['name'],
            email: $properties['email'],
            mobile: $properties['mobile'],
            type: RecipientType::from($properties['type']),
            status: RecipientStatus::from($properties['status']),
            message: $properties['message'],
            password: $properties['password'],
            muted: $properties['muted'],
            order: $properties['order'],
            declinedReason: $properties['declined_reason'],
            created: DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['created']),
            sent: $properties['sent'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['sent']) : null,
            declined: $properties['declined'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['declined']) : null,
            completed: $properties['completed'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['completed']) : null,
            redirects: Redirects::fromArray($properties['redirects']),
        );
    }
}
