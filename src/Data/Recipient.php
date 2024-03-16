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

    public static function fromArray(array $recipient): self
    {
        return new self(
            id: $recipient['id'],
            name: $recipient['name'],
            email: $recipient['email'],
            mobile: $recipient['mobile'],
            type: RecipientType::from($recipient['type']),
            status: RecipientStatus::from($recipient['status']),
            message: $recipient['message'],
            password: $recipient['password'],
            muted: $recipient['muted'],
            order: $recipient['order'],
            declinedReason: $recipient['declined_reason'],
            created: DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $recipient['created']),
            sent: $recipient['sent'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $recipient['sent']) : null,
            declined: $recipient['declined'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $recipient['declined']) : null,
            completed: $recipient['completed'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $recipient['completed']) : null,
            redirects: Redirects::fromArray($recipient['redirects']),
        );
    }
}
