<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data;

use DateTimeImmutable;
use Dyrynda\Annature\Enum\RecipientStatus;
use Dyrynda\Annature\Enum\RecipientType;

final readonly class Recipient extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $id = null,
        public ?string $mobile = null,
        public ?RecipientType $type = RecipientType::Signer,
        public ?RecipientStatus $status = null,
        public ?string $message = null,
        public string|bool|null $password = null,
        public bool $muted = false,
        public ?int $order = null,
        public ?string $declinedReason = null,
        public ?DateTimeImmutable $created = null,
        public ?DateTimeImmutable $sent = null,
        public ?DateTimeImmutable $declined = null,
        public ?DateTimeImmutable $completed = null,
        public ?Redirects $redirects = null,
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
