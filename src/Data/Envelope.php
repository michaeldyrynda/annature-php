<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data;

use DateTimeImmutable;
use Dyrynda\Annature\Enum\EnvelopeStatus;

final readonly class Envelope extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $message,
        public EnvelopeStatus $status,
        public bool $shared,
        public DateTimeImmutable $created,
        public ?DateTimeImmutable $sent,
        public ?DateTimeImmutable $voided,
        public ?DateTimeImmutable $declined,
        public ?DateTimeImmutable $completed,
        public ?string $master,
        public ?string $certificate,
        public string $accountId,
        public ?string $groupId,
        /** @var \App\Data\Recipient[] */
        public array $recipients,
        /** @var array<string, mixed> */
        public array $metadata
    ) {
    }

    public static function fromArray(array $properties): static
    {
        return new self(
            id: $properties['id'],
            name: $properties['name'],
            message: $properties['message'],
            status: EnvelopeStatus::from($properties['status']),
            shared: $properties['shared'],
            created: DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['created']),
            sent: $properties['sent'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['sent']) : null,
            voided: $properties['voided'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['voided']) : null,
            declined: $properties['declined'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['declined']) : null,
            completed: $properties['completed'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['completed']) : null,
            master: $properties['master'] ?? null,
            certificate: $properties['certificate'] ?? null,
            accountId: $properties['account_id'],
            groupId: $properties['group_id'],
            recipients: $properties['recipients'],
            metadata: $properties['metadata'] ?? [],
        );
    }
}
