<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data;

use DateTimeImmutable;
use Dyrynda\Annature\Enum\EnvelopeStatus;
use Illuminate\Support\Collection;

final readonly class Envelope extends Data
{
    public function __construct(
        public string $name,
        public string $accountId,
        /** @var \App\Data\Recipient[] */
        public Collection $recipients,
        public ?string $id = null,
        public ?string $message = null,
        public ?EnvelopeStatus $status = null,
        public ?DateTimeImmutable $created = null,
        public ?DateTimeImmutable $sent = null,
        public ?DateTimeImmutable $voided = null,
        public ?DateTimeImmutable $declined = null,
        public ?DateTimeImmutable $completed = null,
        public ?string $original = null,
        public ?string $master = null,
        public ?string $certificate = null,
        public ?string $groupId = null,
        public ?bool $shared = null,
        public ?bool $draft = null,
        /** @var array<array-key, \App\Data\Document>|null */
        public ?Collection $documents = null,
        /** @var array<string, mixed> */
        public array $metadata = [],
    ) {
    }

    public static function fromArray(array $properties): static
    {
        return new self(
            id: $properties['id'],
            name: $properties['name'],
            message: $properties['message'],
            status: EnvelopeStatus::tryFrom($properties['status'] ?? ''),
            shared: $properties['shared'],
            created: $properties['created'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['created']) : null,
            sent: $properties['sent'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['sent']) : null,
            voided: $properties['voided'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['voided']) : null,
            declined: $properties['declined'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['declined']) : null,
            completed: $properties['completed'] ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['completed']) : null,
            original: $properties['original'] ?? null,
            master: $properties['master'] ?? null,
            certificate: $properties['certificate'] ?? null,
            accountId: $properties['account_id'],
            groupId: $properties['group_id'],
            recipients: collect($properties['recipients'])->map(fn (array $recipient) => Recipient::fromArray($recipient)),
            metadata: $properties['metadata'] ?? [],
        );
    }
}
