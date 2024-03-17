<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data;

use Illuminate\Support\Collection;

final readonly class CreateEnvelopeData extends Data
{
    public function __construct(
        public string $name,
        public ?string $message,
        public string $accountId,
        /** @var \Illuminate\Support\Collection<array-key, \Dyrynda\Annature\Data\CreateDocumentData> */
        public Collection $documents,
        /** @var \Illuminate\Support\Collection<array-key, \Dyrynda\Annature\Data\CreateRecipientData> */
        public Collection $recipients,
        public bool $shared = false,
        public bool $draft = false,
        public ?string $groupId = null,
        /** @var array<string, mixed> */
        public array $metadata = [],
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'message' => $this->message,
            'shared' => $this->shared,
            'draft' => $this->draft,
            'account_id' => $this->accountId,
            'documents' => $this->documents->toArray(),
            'recipients' => $this->recipients->toArray(),
            'group_id' => $this->groupId,
            'metadata' => $this->metadata,
        ], fn ($value) => ! is_null($value) && ! empty($value));
    }
}
