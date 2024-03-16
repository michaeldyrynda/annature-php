<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Requests\Envelopes;

use DateTimeImmutable;
use Dyrynda\Annature\Enum\EnvelopeStatus;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class ListEnvelopesRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?string $name = null,
        protected ?EnvelopeStatus $status = null,
        protected ?string $recipient = null,
        protected ?DateTimeImmutable $createdBefore = null,
        protected ?DateTimeImmutable $createdAfter = null,
        protected ?DateTimeImmutable $completedBefore = null,
        protected ?DateTimeImmutable $completedAfter = null,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/envelopes';
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'name' => $this->name,
            'status' => $this->status?->value,
            'recipient' => $this->recipient,
            'created_before' => $this->createdBefore?->format('Y-m-d\TH:i:s\Z'),
            'created_after' => $this->createdAfter?->format('Y-m-d\TH:i:s\Z'),
            'completed_before' => $this->completedBefore?->format('Y-m-d\TH:i:s\Z'),
            'completed_after' => $this->completedAfter?->format('Y-m-d\TH:i:s\Z'),
        ]);
    }
}
