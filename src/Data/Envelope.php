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
        public ?string $original,
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

    public static function fromArray(array $envelope): self
    {
        return new self(
            id: $envelope['id'],
            name: $envelope['name'],
            message: $envelope['message'],
            status: EnvelopeStatus::from($envelope['status']),
            shared: $envelope['shared'],
            created: DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $envelope['created']),
            sent: $envelope['sent'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $envelope['sent']) : null,
            voided: $envelope['voided'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $envelope['voided']) : null,
            declined: $envelope['declined'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $envelope['declined']) : null,
            completed: $envelope['completed'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $envelope['completed']) : null,
            original: $envelope['original'] ?? null,
            master: $envelope['master'] ?? null,
            certificate: $envelope['certificate'] ?? null,
            accountId: $envelope['account_id'],
            groupId: $envelope['group_id'],
            recipients: array_map(fn (array $recipient) => Recipient::fromArray($recipient), $envelope['recipients']),
            metadata: $envelope['metadata'] ?? [],
        );
    }
}
